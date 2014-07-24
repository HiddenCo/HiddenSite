<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/14/14
 * Time: 9:22 PM
 */
require('AmazonECS.class.php');
class AmazonApi {

    private static $instance;
    private $awz_ecs;

    public function __construct()
    {
        $sql="select * from user_settings where user_id=?";
        $result=DB::select($sql,array(Session::get('user_id')));

        if($result!=null && count($result)>0) {
            $amazon_id=Config::get('aws.aws_key');
            $amazon_secret=Config::get('aws.aws_secret');
            $amazon_associate=Config::get('aws.aws_associate_tag');
            $lang=$result[0]->lang;

            $this->awz_ecs=new AmazonECS($amazon_id,$amazon_secret,$lang,$amazon_associate);
        }
    }
    public static function getInstance()
    {
        if(self::$instance==null) {
            self::$instance=new AmazonApi();
        }
        return self::$instance;
    }
    public function getProductInformation($awz_product_id)
    {
        $this->awz_ecs->returnType(AmazonECS::RETURN_TYPE_ARRAY);
        $response=$this->awz_ecs->responseGroup('Large,EditorialReview')->lookup($awz_product_id);




        if(!array_key_exists('Items',$response)) {
            throw new Exception('The response is wrong format');
        }

        if(!array_key_exists('Item',$response['Items'])) {
            throw new Exception('The response is wrong format');
        }

        if(array_key_exists('ItemAttributes',$response['Items']['Item'])) {
            $title=$response['Items']['Item']['ItemAttributes']['Title'];
        } else {
            $title="Not Found";
        }


        if(array_key_exists('Offers',$response['Items']['Item'])) {
            if(array_key_exists('Offer',$response['Items']['Item']['Offers'])) {
                $availability=$response['Items']['Item']['Offers']['Offer']['OfferListing']['Availability'];
            }else {
                $availability="Not Found";
            }

        } else {
            $availability="Not Found";
        }


        if(array_key_exists('Offers',$response['Items']['Item'])) {
            if(array_key_exists('Offer',$response['Items']['Item']['Offers'])) {

                $price=$response['Items']['Item']['Offers']['Offer']['OfferListing']['Price']['FormattedPrice'];
                $price=floatval(substr($price,1));

            }else {
                $price=0;
            }
        } else {
            $price=0;
        }


        if(array_key_exists('EditorialReviews',$response['Items']['Item'])) {
            if(is_array($response['Items']['Item']['EditorialReviews']['EditorialReview'])) {
                if(array_key_exists('Content',$response['Items']['Item']['EditorialReviews']['EditorialReview'][0])) {

                    $description=$response['Items']['Item']['EditorialReviews']['EditorialReview'][0]['Content'];
                } else {
                    $description="Not Found";
                }
            } else {
                if(array_key_exists('Content',$response['Items']['Item']['EditorialReviews']['EditorialReview'])) {

                    $description=$response['Items']['Item']['EditorialReviews']['EditorialReview']['Content'];
                } else {
                    $description="Not Found";
                }
            }


        } else {
            $description="Not Found";
        }

        //$Description=

        $image=$response['Items']['Item']['LargeImage']['URL'];

        $img_url_encode=urlencode($image);
        $link="http://i.embed.ly/1/image/resize?url=".$img_url_encode."&key=14ac1d6a581c48e0af0c61ba5ed9fd70&height=2000&grow=true";

        // upload to Imgur

        $image=ImgurAPI::uploadImage($link,Config::get('aws.imgur_client_id'));


        if(array_key_exists('Feature',$response['Items']['Item']['ItemAttributes']))
        {
            $feature=$response['Items']['Item']['ItemAttributes']['Feature'];
        } else
        {
            $feature="Not Found";
        }

        if(is_array($feature))
        {
            $feature_data='';
            foreach($feature as $key) {
                $feature_data.=$key."\n";
            }
            $feature=$feature_data;
        }


        if(array_key_exists('DetailPageURL',$response['Items']['Item'])) {
            $source_url=$response['Items']['Item']['DetailPageURL'];
        } else {
            $source_url='';
        }

        $result=array('product_id'=>$awz_product_id,'title'=>$title,'availability'=>$availability,
                    'price'=>$price,'image'=>$image,'feature'=>$feature,
                    'description'=>$description,'source_url'=>$source_url);

        return $result;
    }


} 