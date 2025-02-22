<?php




\Illuminate\Support\Facades\Route::get('/api/image-generate-tn-request/{cache_id}', function ($mediaId) {

    $mediaId = str_replace('..', '', $mediaId);
    $check = \MicroweberPackages\Media\Models\MediaThumbnail::where('id', $mediaId)->first();

    if ($check) {
        $opts = $check->image_options;
        $opts = app()->url_manager->replace_site_url_back($opts);
        $cache_id_data_json = $opts;
        $cache_id_data_json['cache_id'] = $check->rel_id;

        $tn = mw()->media_manager->thumbnail_img($cache_id_data_json);
        return $tn;
    }


    return mw()->media_manager->pixum_img();
});

