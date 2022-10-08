<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\ProductsImport;
use App\Models\ProductsExport;
use PDF;
use Excel;
use Auth;
use Illuminate\Support\Facades\Route;
use DB;
class ProductImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                return view('product_import.index');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function import(Request $request){
        
       

                 if(!empty($request->bulk_file)){
            $csv_file = $request->bulk_file;
           if (($getfile = fopen($csv_file, "r")) !== FALSE) {
               ini_set('memory_limit', '-1');
                $data = fgetcsv($getfile, 100000, ",");
                $inum=2;
                $query = " ";
                $ch_data=array();
                while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
                    $result = $data;
                    $result1  = str_replace(",","",$result);  
                    $str = implode(",", $result1);
                    $slice = explode(",", $str);
                    // dd($slice);
    
            $sr_no = $slice[0];
            $name = $slice[1];
            $added_by = $slice[2];
            $user_id = $slice[3];
            $category_id = $slice[4];
            $brand_id = $slice[5];
            $photos = !empty($slice[6])?$slice[6]:'0';
            $thumbnail_img = !empty($slice[7])?$slice[7]:'0';
            $video_provider =  !empty($slice[8])?$slice[8]:'0';
            $video_link = !empty($slice[9])?$slice[9]:'0';
            $tags = !empty($slice[10])?$slice[10]:'0';
            // $description = !empty($slice[11])?$slice[11]:'0';
            $description = 'test';            
            $short = !empty($slice[12])?$slice[12]:'0';
            $unit_price = !empty($slice[13])?$slice[13]:'0';
            $purchase_price = !empty($slice[14])?$slice[14]:'0'; 
            $variant_product = !empty($slice[15])?$slice[15]:'0';
            $attributes = !empty($slice[16])?$slice[16]:'0';
            $choice_options = !empty($slice[17])?$slice[17]:'0';
            $colors = !empty($slice[18])?$slice[18]:'0';
            $variations = !empty($slice[19])?$slice[19]:'0';
            $todays_deal = !empty($slice[20])?$slice[20]:'0';
            $published = !empty($slice[21])?$slice[21]:'0';
            $approved = !empty($slice[22])?$slice[22]:'0';
            $stock_visibility_state = !empty($slice[23])?$slice[23]:'0';
            $cash_on_delivery = !empty($slice[24])?$slice[24]:'0';
            $featured = !empty($slice[25])?$slice[25]:'0';
            $seller_featured = !empty($slice[26])?$slice[26]:'0';
            $current_stock = !empty($slice[27])?$slice[27]:'0';
            $unit = !empty($slice[28])?$slice[28]:'0';
            $weight = !empty($slice[29])?$slice[29]:'0';
            $min_qty = !empty($slice[30])?$slice[30]:'0';
            $low_stock_quantity = !empty($slice[31])?$slice[31]:'0';
            $discount = !empty($slice[32])?$slice[32]:'0';
            $discount_type = !empty($slice[33])?$slice[33]:'0';
            $discount_start_date = !empty($slice[34])?$slice[34]:'0';
            $discount_end_date = !empty($slice[35])?$slice[35]:'0';
            $tax = !empty($slice[36])?$slice[36]:'0';
            $tax_type = !empty($slice[37])?$slice[37]:'0';
            $shipping_type = !empty($slice[38])?$slice[38]:'0';
            $shipping_cost = !empty($slice[39])?$slice[39]:'0';
            $is_quantity_multiplied = !empty($slice[40])?$slice[40]:'0';
            $est_shipping_days = !empty($slice[41])?$slice[41]:'0';
            $num_of_sale = !empty($slice[42])?$slice[42]:'0';
            $meta_title = !empty($slice[43])?$slice[43]:'0';
            // $meta_description = !empty($slice[44])?$slice[44]:'0';
            $meta_description = 'test';
            $meta_img = !empty($slice[45])?$slice[45]:'0';
            $pdf = !empty($slice[46])?$slice[46]:'0';
            $slug = !empty($slice[47])?$slice[47]:'0';
            $rating = !empty($slice[48])?$slice[48]:'0';
            $barcode = !empty($slice[49])?$slice[49]:'0';
            $digital = !empty($slice[50])?$slice[50]:'0';
            $auction_product = !empty($slice[51])?$slice[51]:'0';
            $file_name = !empty($slice[52])?$slice[52]:'0';
            $file_path = !empty($slice[53])?$slice[53]:'0';
            $external_link = !empty($slice[54])?$slice[54]:'0';
            $external_link_btn = !empty($slice[55])?$slice[55]:'0';
            $wholesale_product = !empty($slice[56])?$slice[56]:'0';
            $created_at = !empty($slice[57])?$slice[57]:'0';
            $updated_at = !empty($slice[58])?$slice[58]:'0';
            $sku = !empty($slice[59])?$slice[59]:'0';
            $visiblity_in_catalog = !empty($slice[60])?$slice[60]:'0';
            $short_description = !empty($slice[61])?$slice[61]:'0';
            $date_sale_price_starts = !empty($slice[62])?$slice[62]:'0';
            $date_sale_price_ends = !empty($slice[63])?$slice[63]:'0';
            $in_stock = !empty($slice[64])?$slice[64]:'0';
            $backorder_allowed = !empty($slice[65])?$slice[65]:'0';
            $sold_individually = !empty($slice[66])?$slice[66]:'0';
            $lenth_in_cm = !empty($slice[67])?$slice[67]:'0';
            $width_in_cm = !empty($slice[68])?$slice[68]:'0';
            $height_in_cm = !empty($slice[69])?$slice[69]:'0';
            $allowed_custumer_reviews = !empty($slice[70])?$slice[70]:'0';
            $sale_price = !empty($slice[71])?$slice[71]:'0';
            $regular_price = !empty($slice[72])?$slice[72]:'0';
            $categories = !empty($slice[73])?$slice[73]:'0';
            $images = !empty($slice[74])?$slice[74]:'0';
            $download_limit = !empty($slice[75])?$slice[75]:'0';
            $download_expiry_days = !empty($slice[76])?$slice[76]:'0';
            $parent = !empty($slice[77])?$slice[77]:'0';
            $grouped_products = !empty($slice[78])?$slice[78]:'0';
            $woodmart_product_hashtag = !empty($slice[79])?$slice[79]:'0';
            $yoast_wpseo_primary_product_cat = !empty($slice[80])?$slice[80]:'0';
            $rs_page_bg_color = !empty($slice[81])?$slice[81]:'0';
            $woolentor_views_count_product = !empty($slice[82])?$slice[82]:'0';
            $attribute1_name = !empty($slice[83])?$slice[83]:'0';
            $attribute1_value1 = !empty($slice[84])?$slice[84]:'0';
            $attribute1_visible =!empty($slice[85])?$slice[85]:'0'; 
            $attribute1_global = !empty($slice[86])?$slice[86]:'0';
            $woolentor_total_stock_quantity = !empty($slice[87])?$slice[87]:'0';
            $saleflash_text = !empty($slice[88])?$slice[88]:'0';
            $yoast_wpseo_wordproof_timestamp = !empty($slice[89])?$slice[89]:'0';
            $fb_product_group_id = !empty($slice[90])?$slice[90]:'0';
            $rednao_advanced_product_options = !empty($slice[91])?$slice[91]:'0';
            $wc_facebook_sync_enabled = !empty($slice[92])?$slice[92]:'0';
            $fb_visibility = !empty($slice[93])?$slice[93]:'0';
            $fb_product_description =!empty($slice[94])?$slice[94]:'0';
            $wc_facebook_product_image_source =!empty($slice[95])?$slice[95]:'0';
            $wc_facebook_commerce_enabled =!empty($slice[96])?$slice[96]:'0';
            $fb_product_item_id = !empty($slice[97])?$slice[97]:'0';
            $rednao_advanced_product_fees = !empty($slice[98])?$slice[98]:'0';
            $yoast_wpseo_focuskw = !empty($slice[99])?$slice[99]:'0';
            $yoast_wpseo_title = !empty($slice[100])?$slice[100]:'0';
            $yoast_wpseo_metadesc = !empty($slice[101])?$slice[101]:'0';
            $yoast_wpseo_linkdex = !empty($slice[102])?$slice[102]:'0';
            $attribute2_name = !empty($slice[103])?$slice[103]:'0';
            $attribute2_value = !empty($slice[104])?$slice[104]:'0';
            $attribute2_visible = !empty($slice[105])?$slice[105]:'0';
            $attribute2_global = !empty($slice[106])?$slice[106]:'0';
            $fb_product_image = !empty($slice[107])?$slice[107]:'0';
            $fb_product_price = !empty($slice[108])?$slice[108]:'0'; 
            $wp_desired_post_slug = !empty($slice[109])?$slice[109]:'0';
            $button_text = !empty($slice[110])?$slice[110]:'0';
            $upsells = !empty($slice[111])?$slice[111]:'0';
            $cross_sells = !empty($slice[112])?$slice[112]:'0';
            $external_url = !empty($slice[113])?$slice[113]:'0'; 
            $position = !empty($slice[114])?$slice[114]:'0';
            $import_user_slug = !empty($slice[115])?$slice[115]:'0';
            $wxr_import_user_slug = !empty($slice[116])?$slice[116]:'0';
            $last_editor_used_jetpack = !empty($slice[117])?$slice[117]:'0';
            $wp_old_date = !empty($slice[118])?$slice[118]:'0';
            $yoast_wpseo_content_score = !empty($slice[119])?$slice[119]:'0';
            $yoast_wpseo_estimated_reading_time_minutes =  !empty($slice[120])?$slice[120]:'0';
            // $minutes = !empty($slice[130])?$slice[130]:'0';
            $nickx_video_text_url = !empty($slice[121])?$slice[121]:'0';
            $nickx_product_video_type = !empty($slice[122])?$slice[122]:'0';
            $custom_thumbnail = !empty($slice[123])?$slice[123]:'0';
            $woodmart_sguide_select = !empty($slice[124])?$slice[124]:'0';
            $woodmart_total_stock_quantity = !empty($slice[125])?$slice[125]:'0';
            $product_360_image_gallery = !empty($slice[126])?$slice[126]:'0';
            $woodmart_whb_header = !empty($slice[127])?$slice[127]:'0';
            $woodmart_main_layout = !empty($slice[128])?$slice[128]:'0';
            $woodmart_sidebar_width = !empty($slice[129])?$slice[129]:'0';
            $woodmart_custom_sidebar = !empty($slice[130])?$slice[130]:'0';
            $woodmart_product_design = !empty($slice[131])?$slice[131]:'0';
            $woodmart_single_product_style =!empty($slice[132])?$slice[132]:'0';
            $woodmart_thums_position = !empty($slice[133])?$slice[133]:'0';
            $woodmart_product_background = !empty($slice[134])?$slice[134]:'0';
            $woodmart_extra_content = !empty($slice[135])?$slice[135]:'0';
            $woodmart_extra_position = !empty($slice[136])?$slice[136]:'0';
            $woodmart_product_custom_tab_title = !empty($slice[137])?$slice[137]:'0';
            $woodmart_product_custom_tab_content = !empty($slice[138])?$slice[138]:'0';
            $woodmart_swatches_attribute = !empty($slice[139])?$slice[139]:'0';
            $woodmart_product_vide = !empty($slice[140])?$slice[140]:'0';
            

    DB::INSERT("INSERT INTO products Values(0,'".$name."','".$added_by."','".$user_id."','".$category_id."','".$brand_id."','".$photos."','".$thumbnail_img."','".$video_provider."','".$video_link."','".$tags."',
    '".$description."','".$short."','".$unit_price."','".$purchase_price."','".$variant_product."','".$attributes."','".$choice_options."','".$colors."','".$variations."','".$todays_deal."','".$published."',
    '".$approved."','".$stock_visibility_state."','".$cash_on_delivery."','".$featured."','".$seller_featured."','".$current_stock."','".$unit."','".$weight."','".$min_qty."','".$low_stock_quantity."',
    '".$discount."','".$discount_type."','".$discount_start_date."','".$discount_end_date."','".$tax."','".$tax_type."','".$shipping_type."','".$shipping_cost."','".$is_quantity_multiplied."','".$est_shipping_days."'
    ,'".$num_of_sale."','".$meta_title."','".$meta_description."','".$meta_img."','".$pdf."','".$slug."','".$rating."','".$barcode."','".$digital."','".$auction_product."','".$file_name."',
    '".$file_path."','".$external_link."','".$external_link_btn."','".$wholesale_product."','".$created_at."','".$updated_at."','".$sku."','".$visiblity_in_catalog."','".$short_description."','".$date_sale_price_starts."'
,'".$date_sale_price_ends."','".$in_stock."','".$backorder_allowed."','".$sold_individually."','".$lenth_in_cm."','".$width_in_cm."','".$height_in_cm."','".$allowed_custumer_reviews."',
'".$sale_price."','".$regular_price."','".$categories."','".$images."','".$download_limit."','".$download_expiry_days."','".$parent."','".$grouped_products."','".$woodmart_product_hashtag."',
'".$yoast_wpseo_primary_product_cat."','".$rs_page_bg_color."','".$woolentor_views_count_product."','".$attribute1_name."','".$attribute1_value1."','".$attribute1_visible."','".$attribute1_global."',
'".$woolentor_total_stock_quantity."','".$saleflash_text."','".$yoast_wpseo_wordproof_timestamp."','".$fb_product_group_id."','".$rednao_advanced_product_options."','".$wc_facebook_sync_enabled."',
'".$fb_visibility."','".$fb_product_description."','".$wc_facebook_product_image_source."','".$wc_facebook_commerce_enabled."','".$fb_product_item_id."','".$rednao_advanced_product_fees."',
'".$yoast_wpseo_focuskw."','".$yoast_wpseo_title."','".$yoast_wpseo_metadesc."','".$yoast_wpseo_linkdex."','".$attribute2_name."','".$attribute2_value."','".$attribute2_visible."','".$attribute2_global."',
'".$fb_product_image."','".$fb_product_price."','".$wp_desired_post_slug."','".$button_text."','".$upsells."','".$cross_sells."','".$external_url."','".$position."','".$import_user_slug."','".$wxr_import_user_slug."',
'".$last_editor_used_jetpack."','".$wp_old_date."','".$yoast_wpseo_content_score."','".$yoast_wpseo_estimated_reading_time_minutes."','".$nickx_video_text_url."','".$nickx_product_video_type."','".$custom_thumbnail."',
'".$woodmart_sguide_select."','".$woodmart_total_stock_quantity."','".$product_360_image_gallery."','".$woodmart_whb_header."','".$woodmart_main_layout."','".$woodmart_sidebar_width."','".$woodmart_custom_sidebar."',
'".$woodmart_product_design."','".$woodmart_single_product_style."','".$woodmart_thums_position."','".$woodmart_product_background."' , '".$woodmart_extra_content."','".$woodmart_extra_position."',
'".$woodmart_product_custom_tab_title."','".$woodmart_product_custom_tab_content."','".$woodmart_swatches_attribute."','".$woodmart_product_vide."')");
            }
        }
    }

         
        return back();
     }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
