<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 9/9/14
 * Time: 12:44 AM
 */

class WalmartAPI {
    private $apikey='svhu2zpynsa4w7zrs9km2xr8';
    public function getProductInformation($product_id)
    {
        $url="http://walmartlabs.api.mashery.com/v1/items/".$product_id."?format=json&apiKey=".$this->apikey;

        $data=file_get_contents($url);

        if(isset($data)) {
            $json_data=json_decode($data);
        } else {
            $json_data= null;
        }

        $title=$json_data->name;
        $availability='';
        $price=$json_data->salePrice;

        $large_image=$json_data->largeImage;

        $img_url_encode=urlencode($large_image);

        $link="http://i.embed.ly/1/image/resize?url=".$img_url_encode."&key=14ac1d6a581c48e0af0c61ba5ed9fd70&height=2000&grow=true";

        // upload to Imgur

        $image=ImgurAPI::uploadImage($link,Config::get('aws.imgur_client_id'));

        $feature=$json_data->longDescription;

        $description=$json_data->shortDescription;

        $source_url=$json_data->productUrl;

        $result=array('product_id'=>$product_id,'title'=>$title,'availability'=>$availability,
            'price'=>$price,'image'=>$image,'feature'=>$feature,
            'description'=>$description,'source_url'=>$source_url);

        return $result;
    }

} 