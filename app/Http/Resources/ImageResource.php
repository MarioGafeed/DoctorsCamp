<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use Laravel\Sanctum\PersonalAccessToken;


class ImageResource extends JsonResource
{
    public function toArray($request)
    {
      $user  = $request->user();
// $post_data = request()->header('authorization');
// dd($post_data['user_token']);
// if (isset($post_data['user_token'])) {
//     [$id, $user_token] = explode('|', $post_data['user_token'], 2);
//     $token_data = DB::table('personal_access_tokens')->where('token', hash('sha256', $partner_token))->first();
//     $user_id = $user_id->tokenable_id; // !!!THIS ID WE CAN USE TO GET DATA OF YOUR USER!!!//
//     dd($user_id);
// }

      if ($user !== null){
        return [
            'id'         => $this->id,
            'title'      => $this['title_' . request()->header('accept-language', 'en')],
            'category'   => $this->category['title_' . request()->header('accept-language', 'en')],
            'category_id'=> $this->category->id,
            'image'      => $this->getFirstMediaUrl(),
            'description'=> json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
            'likes_count'=> $this->likes()->count(),
            'user_like?' => $this->liked($user->id),
            'data_time'  => (string) $this->updated_at,
        ];
      }else {
        return [
            'id'         => $this->id,
            'title'      => $this['title_' . request()->header('accept-language', 'en')],
            'category'   => $this->category['title_' . request()->header('accept-language', 'en')],
            'category_id'=> $this->category->id,
            'image'      => $this->getFirstMediaUrl(),
            'description'=> json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
            'likes_count'=> $this->likes()->count(),
            'data_time'  => (string) $this->updated_at,
        ];
      }
    }
}
