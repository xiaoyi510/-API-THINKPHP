<?php
    /**
     * 创建者:帅哥杨
     * QQ:203521819
     * Date: 2016/11/8
     * Time: 10:40
     */

    /**
     * 处理多重数组  类似:  a[] = 1 a[] = 2 这种数据
     *
     * @param $array
     *
     * @return array  返回结果数据
     *
     * 使用例子
     * $params = getArray([
            'paramName'=>$_data['paramName'],
            'paramType'=>$_data['paramType'],
            'paramMust'=>$_data['paramMust'],
            'paramDefault'=>$_data['paramDefault'],
            'paramText'=>$_data['paramText']
            ]);
     *
     * 返回数据
     * array(2) {
        [0] => array(5) {
            ["paramName"] => string(4) "sign"
            ["paramType"] => string(6) "String"
            ["paramMust"] => string(1) "1"
            ["paramDefault"] => string(0) ""
            ["paramText"] => string(12) "请求密钥"
        }
        [1] => array(5) {
            ["paramName"] => string(2) "ga"
            ["paramType"] => string(6) "String"
            ["paramMust"] => string(1) "1"
            ["paramDefault"] => string(0) ""
            ["paramText"] => string(2) "ga"
        }
    }

     */
    function getArray($array)
    {
        // 复制一份数组 避免被修改
        $copyArr = $array;
        // 取出第一个数组的的数组数量
        $count = count(array_shift($copyArr));
        // 获取第一个子数组的数量
        $arrayCount = count($array);
        // 取出所有键值
        $keys = array_keys($array);

        // 返回的新数组
        $new = [];
        // 循环处理所有数组 组装新的数组
        for ($i = 0; $i < $count; ++$i) {
            $GLOBALS['i'] = $i;
//            $num = [];
//            // 讲当前下标放到数组中 因为 map 每个数组 都会一个一个 对应的传递
//            for ($jj = 0; $jj < $arrayCount; ++$jj) {
//                $num[] = $i;
//            }

            // 处理数组
            $new[] = array_map(function ($arr) {
                return $arr[$GLOBALS['i']];
            }, $array);

        }
//        // 将索引数组 转为 关联数组
//        foreach ($new as $key => &$item) {
//            // 循环处理键
//            for ($k = 0; $k < $arrayCount; ++$k) {
//                $item[$keys[$k]] = $item[$k];
//                unset($item[$k]);
//            }
//        }

        // 返回处理后的结果
        return $new;
    }