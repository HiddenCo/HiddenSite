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
            $amazon_id=$result[0]->aws_access_key;
            $amazon_secret=$result[0]->aws_access_secret;
            $amazon_associate=$result[0]->aws_associate_tag;
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



        $title=$response['Items']['Item']['ItemAttributes']['Title'];

        $availability=$response['Items']['Item']['Offers']['Offer']['OfferListing']['Availability'];

        $price=$response['Items']['Item']['Offers']['Offer']['OfferListing']['Price']['Amount'];

        if(array_key_exists('EditorialReviews',$response['Items']['Item'])) {
            $description=$response['Items']['Item']['EditorialReviews']['EditorialReview']['Content'];
        } else {
            $description="Not Found";
        }

        //$Description=

        $image=$response['Items']['Item']['LargeImage']['URL'];

        if(array_key_exists('Feature',$response['Items']['Item']['ItemAttributes']))
        {
            $feature=$response['Items']['Item']['ItemAttributes']['Feature'];
        } else
        {
            $feature="Not Found";
        }

        $result=array('product_id'=>$awz_product_id,'title'=>$title,'availability'=>$availability,
                    'price'=>$price,'image'=>$image,'feature'=>$feature,'description'=>$description);

        return $result;
    }


} 