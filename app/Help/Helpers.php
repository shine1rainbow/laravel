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

