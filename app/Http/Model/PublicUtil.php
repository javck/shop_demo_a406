<?php

namespace App\Http\Model;

class PublicUtil
{
//將標籤ids字串，轉換成標籤標題字串
public static function transferTagIdsToTagTitles($tagsStr){
    if (isset($tagsStr) && strlen($tagsStr) > 0) {
        $str_tags = substr($tagsStr , 1 , count($tagsStr)-2);
        $tag_ary = explode(',' , $str_tags);
        for ($i=0; $i < count($tag_ary) ; $i++) {
            $tag = Tag::findOrFail($tag_ary[$i]);
            $tag_ary[$i] = $tag->title;
        }
        return implode("," , $tag_ary);
    }else{
        return null;
    }
}

//取得Storage資料夾裡頭子資料夾的檔案清單，isPath是否包含路徑
public static function getFolderAry($dictionary,$isPath){
    $_results = Storage::files($dictionary);
    if (!$isPath) {
        $results= array();
        foreach ($_results as $value) {
            $results[] = str_replace($dictionary.'/','',$value);
        }
        return $results;
    }
    return $_results;
}

//處理Tag標籤的新增，第二參數為新增標籤的類型
public static function handleTag(Request $request , $type)
{
    if ($request->has('tags_list')){
        $tags = $request->input('tags_list');
        foreach ($tags as $key => $value) {
            if (is_null(Tag::where('id',$value)->first())) {
                $newTag = Tag::create(['title' => $value , 'link' => '#' , 'type' => $type]);
                $tags[$key] = $newTag->id;
            }
        }
    }else{
        $tags = null;
    }

    return $tags;
}

//處理索引頁上方的過濾器，同時確認輸入項和Session是否有值來研判是否需要下此條件
//第一參數為輸入項陣列，第二參數為要處理的輸入項id
public static function handleSearchFilter($inputs,$id){
    $queryId = null;
    if ( isset($inputs[$id]) ) {
        if ( $inputs[$id] != 'none') {
            $queryId = $inputs[$id];
            Session::put($id, $queryId);
        }else{
            if ( Session::has($id) ) {
                Session::forget($id);
            }
        }
    }else{
        if ( Session::has($id) ) {
            $queryId = Session::get($id);
        }
    }
    return $queryId;
}

//回傳Constant Dropdown的key選單之對應鍵值
//$constantKey Constant Dropdown key
//$key 對應鍵陣列
public static function getConstDropDownVal($constantKey,$key){
    $result = __('not_found_option');
    if(isset($constantKey) && isset($key)){
        $setting = json_decode(setting('constant.'. $constantKey),true);
        if(is_array($key)){
            $tmp ="";
            foreach ($key as $item) {
                if(strlen($tmp) > 0){
                    $tmp = $tmp . ',';
                }
                if(isset($setting[$item])){
                    $tmp = $tmp . $setting[$item];
                }
            }
            if(strlen($tmp) > 0 ){
                $result = $tmp;
            }
        }else{
            if(isset($setting[$key])){
                $result = $setting[$key];
            }
        }
    }
    return $result;
}

//回傳Tag Dropdown的key選單之對應鍵值
//$ids 流水號陣列或流水號
public static function getTagDropDownVal($ids){
    $result = '';
    if(isset($ids)){
        if(is_array($ids)){
            $tmp = "";
            foreach ($ids as $id) {
                if(is_numeric($id)){
                    $tag = Tag::findOrFail($id);
                    if(strlen($tmp) > 0){
                        $tmp = $tmp . ',';
                    }
                    $tmp = $tmp . $tag->title;
                }else if($id != ''){
                    $tmp = $tmp . __('not_found_option');
                }
            }
            if(strlen($tmp) > 0){
                $result = $tmp;
            }
        }else if(is_numeric($ids)){
            $tag = Tag::findOrFail($ids);
            if(isset($tag)){
                $result = $tag->title;
            }
        }
    }
    return $result;
}

//回傳排序網址
//$dataType 該頁面的dataType
//$dataRow 該欄位的dataRow
//$orderBy 設定以哪個欄位進行排序
//$sortOrder 排序方式
public static function buildSortUrl($dataType,$dataRow,$orderBy, $sortOrder)
{
    $params = \Request::all();
    $isDesc = $sortOrder != 'asc';
    if ($dataRow->field == $orderBy && $isDesc) {
        $params['sort_order'] = 'asc';
    } else {
        $params['sort_order'] = 'desc';
    }
    $params['order_by'] = $dataRow->field;

    return url('/admin'). '/' .$dataType->slug.'?'.http_build_query($params);
}

/**
 * 獲取當前控制器與方法
 *
 * @return array
 */
public static function getCurrentAction()
{
    $action = Route::current()->getActionName();
    list($class, $method) = explode('@', $action);

    return ['controller' => $class, 'method' => $method];
}

/**
 * 檢查所傳入的Tag陣列有無新的標籤，若有的話進行新增
 *
 * @return array
 */
public static function chkNewTag($tags)
{
    foreach ($tags as $key => $value) {
        if (is_null(Tag::where('id',$value)->first())) {
            $newTag = Tag::create(['title' => $value ,'link' => '#' ,'type' => 'def']);
            $tags[$key] = $newTag->id;
        }
    }
    return $tags;
}

}













