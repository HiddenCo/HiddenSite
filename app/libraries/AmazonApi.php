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
    public function getProductInformation($awz_product_id,$money_format)
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
            $title=str_replace('&','and',$title);
            for ($i = 0; $i < strlen($title); $i++)
            {
                if(ord($title[$i])==34) {
                    $title1=substr($title,0,$i);
                    $tile2=substr($title,$i+1,strlen($title)-$i-1);
                    $title=$title1."&quot;".$tile2;
                    break;
                }
            }
        } else {
            $title="Not Found";
        }

        if(strlen($title)>80){
            $title=substr($title,0,79);
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

        $availability=str_replace('&','and',$availability);



        if(array_key_exists('Offers',$response['Items']['Item'])) {

            if(array_key_exists('Offer',$response['Items']['Item']['Offers'])) {

                if(array_key_exists("SalePrice",$response['Items']['Item']['Offers']['Offer']['OfferListing'])) {
                    $price=$response['Items']['Item']['Offers']['Offer']['OfferListing']['SalePrice']['FormattedPrice'];
                } else {
                    $price=$response['Items']['Item']['Offers']['Offer']['OfferListing']['Price']['FormattedPrice'];
                }


                $price=strstr($price,$money_format);
                $price=substr($price,strlen($money_format));

                $price=str_replace(',','',$price);

                $price=floatval($price);

            }else {
                $price=0;
            }
        } else {
            $price=0;
        }


        if(array_key_exists('EditorialReviews',$response['Items']['Item'])) {
            if(is_array($response['Items']['Item']['EditorialReviews']['EditorialReview'])) {

                if(array_key_exists('Content',$response['Items']['Item']['EditorialReviews']['EditorialReview'])) {

                    $description=$response['Items']['Item']['EditorialReviews']['EditorialReview']['Content'];
                } elseif(array_key_exists('0',$response['Items']['Item']['EditorialReviews']['EditorialReview'])){
                    if(array_key_exists('Content',$response['Items']['Item']['EditorialReviews']['EditorialReview'][0])) {

                        $description=$response['Items']['Item']['EditorialReviews']['EditorialReview'][0]['Content'];
                    } else {
                        $description="Not Found";
                    }
                } else {
                    $description="Not Found";
                }
            } else {
                $description="Not Found";
            }
        } else {
            $description="Not Found";
        }

        $description=str_replace('&','and',$description);

        //$Description=



        if(array_key_exists('LargeImage',$response['Items']['Item'])) {
            $image=$response['Items']['Item']['LargeImage']['URL'];
        } elseif(array_key_exists('ImageSets',$response['Items']['Item'])) {
            $image= $response['Items']['Item']['ImageSets']['ImageSet']['LargeImage']['URL'];
        }

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
        $feature=str_replace('&','and',$feature);


        if(array_key_exists('DetailPageURL',$response['Items']['Item'])) {
            $source_url=$response['Items']['Item']['DetailPageURL'];
        } else {
            $source_url='';
        }
        //var_dump($source_url); exit;

        $result=array('product_id'=>$awz_product_id,'title'=>$title,'availability'=>$availability,
                    'price'=>$price,'image'=>$image,'feature'=>$feature,
                    'description'=>$description,'source_url'=>$source_url);

        return $result;
    }


} 