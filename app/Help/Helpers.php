<?php
/*
|--------------------------------------------------------------------------
| Global function
|--------------------------------------------------------------------------
| 
| define common methods for the system
*/

/**
 * 菜单树
 *
 * @param  array $items 菜单数组
 * @return array $menus 格式化后数组
 */
function generateTree($items)
{
    $tree = [];

    foreach ($items as $item) {
        if ($item['pid'] != 0) {
            foreach ($tree as $k => & $v) {
                if ($v['id'] == $item['pid']) {
                    $v['child'][] = $item;
                    $v['child'] = sortMultidimArray($v['child'], 'order', 'asc');
                }
            }
        } else {
            array_push($tree, $item);
        }
    }

    $tree = sortMultidimArray($tree, 'order', 'asc');
    return array_filter($tree);
}

/**
 * 多维数组排序
 *
 * @param  array $list
 * @param  string $field
 * @param  string $sortby
 * @return array/boolean $resultSet/false
 */
function sortMultidimArray(array $list, string $field, string $sortby = 'asc')
{
    if (is_array($list)) {

        $refer = $resultSet = []; 

        foreach ($list as $i => $data) {
            $refer[$i] = &$data[$field];
        }

        switch ($sortby) {
            case 'asc':
                asort($refer);
                break;
            case 'desc':
                arsort($refer);
                break;
            case 'nat':
                natcasesort($refer);
                break;
        }

        foreach ($refer as $key => $val) {
            $resultSet[] = &$list[$key];
        }

        return $resultSet;
    }

    return false;
}

/**
 * 根据起点坐标和终点坐标测距离
 * @param  [array]   $from 	[起点坐标(经纬度),例如:array(118.012951,36.810024)]
 * @param  [array]   $to 	[终点坐标(经纬度)]
 * @param  [bool]    $km    是否以公里为单位 false:米 true:公里(千米)
 * @param  [int]     $decimal 精度 保留小数位数
 * @return [string]  距离数值
 */
function getDistance($from,$to,$km=true,$decimal=2){
    sort($from);
    sort($to);
    $EARTH_RADIUS = 6370.996; // 地球半径系数

    $distance = $EARTH_RADIUS*2*asin(sqrt(pow(sin( ($from[0]*pi()/180-$to[0]*pi()/180)/2),2)+cos($from[0]*pi()/180)*cos($to[0]*pi()/180)* pow(sin( ($from[1]*pi()/180-$to[1]*pi()/180)/2),2)))*1000;

    if($km){
        $distance = $distance / 1000;
    }

    return round($distance, $decimal);
}
