<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\RegionData;
use App\Models\Region;
use Spatie\LaravelData\DataCollection;

class RegionQueryService
{
    public function SearchRegionByName(string $keyword, int $limit = 5): DataCollection
    {
        $regions = Region::where('type', 'village')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('postal_code', 'like', '%' . $keyword . '%')
                    ->orWhereHas('parent', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('parent.parent', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('parent.parent.parent', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
            })->with('parent.parent.parent')->limit($limit)->get();

        return new DataCollection(RegionData::class, $regions);
    }

    public function searchRegionByCode(string $code): RegionData
    {
        return RegionData::fromModel(
            Region::where('code', $code)->first()
        );
    }
}
