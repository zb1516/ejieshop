<?php
// +----------------------------------------------------------------------
// | 农商商城系统 [ 致力于通过产品和服务，帮助商家高效化开拓市场 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017~2021  All rights reserved.
// +----------------------------------------------------------------------
// | Licensed 这不是一个自由软件，不允许对程序代码以任何形式任何目的的再发行
// +----------------------------------------------------------------------
// | Author: 农商科技 <>
// +----------------------------------------------------------------------
declare (strict_types = 1);

/**
 * 应用公共函数库文件
 */

use app\common\library\helper;
use cores\exception\BaseException;
use cores\exception\DebugException;
use think\exception\HttpResponseException;
use think\facade\Config;
use think\facade\Env;
use think\facade\Log;
use think\facade\Request;
use think\Response;

/**
 * 打印调试函数 html
 * @param $content
 * @param bool $export
 */
function pre($content, bool $export = false)
{
    $output = $export ? var_export($content, true) : print_r($content, true);
    echo "<pre>{$output}</pre>";
    app_end();
}

/**
 * 打印调试函数 json
 * @param $content
 * @param bool $export
 * @throws DebugException
 */
function pree($content, bool $export = false)
{
    $output = $export ? var_export($content, true) : $content;
    throw new DebugException([], $output);
}

/**
 * 输出错误信息
 * @param string $message 报错信息
 * @param int|null $status 状态码,默认为配置文件status.error
 * @param array $data 附加数据
 * @throws BaseException
 */
function throwError(string $message, ?int $status = null, array $data = [])
{
    is_null($status) && $status = config('status.error');
    throw new BaseException(['status' => $status, 'message' => $message, 'data' => $data]);
}

/**
 * 下划线转驼峰
 * @param string $uncamelized_words
 * @param string $separator
 * @return string
 */
function camelize(string $uncamelized_words, string $separator = '_'): string
{
    $uncamelized_words = $separator . str_replace($separator, " ", strtolower($uncamelized_words));
    return ltrim(str_replace(" ", "", ucwords($uncamelized_words)), $separator);
}

/**
 * 驼峰转下划线
 * @param string $camelCaps
 * @param string $separator
 * @return string
 */
function uncamelize(string $camelCaps, string $separator = '_'): string
{
    return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
}

/**
 * 生成密码hash值
 * @param string $password
 * @return string
 */
function encryption_hash(string $password): string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * 获取当前域名及根路径
 * @return string
 */
function base_url(): string
{
    static $baseUrl = '';
    if (empty($baseUrl)) {
        $request = Request::instance();
        // url协议，设置强制https或自动获取
        $scheme = Config::get('route')['url_force_https'] ? 'https' : $request->scheme();
        // url子目录
        $rootUrl = root_url();
        // 拼接完整url
        $baseUrl = "{$scheme}://" . $request->host() . $rootUrl;
    }
    return $baseUrl;
}

/**
 * 获取当前url的子目录路径
 * @return string
 */
function root_url(): string
{
    static $rootUrl = '';
    if (empty($rootUrl)) {
        $request = Request::instance();
        $subUrl = str_replace('\\', '/', dirname($request->baseFile()));
        $rootUrl = $subUrl . ($subUrl === '/' ? '' : '/');
    }
    return $rootUrl;
}

/**
 * 获取当前uploads目录访问地址
 * @return string
 */
function uploads_url(): string
{
    return base_url() . 'uploads';
}

/**
 * 获取当前temp目录访问地址
 * @return string
 */
function temp_url(): string
{
    return base_url() . 'temp/';
}

/**
 * 获取当前的应用名称
 * @return mixed
 */
function app_name()
{
    return app('http')->getName();
}

/**
 * 获取web根目录
 * @return string
 */
function web_path(): string
{
    static $webPath = '';
    if (empty($webPath)) {
        $request = Request::instance();
        $webPath = dirname($request->server('SCRIPT_FILENAME')) . DIRECTORY_SEPARATOR;
    }
    return $webPath;
}

/**
 * 获取runtime根目录路径
 * @return string
 */
function runtime_root_path(): string
{
    return dirname(runtime_path()) . DIRECTORY_SEPARATOR;
}

/**
 * 写入日志 (使用tp自带驱动记录到runtime目录中)
 * @param $value
 * @param string $type
 */
function log_record($value, string $type = 'info')
{
    $content = is_string($value) ? $value : print_r($value, true);
    Log::record($content, $type);
}

/**
 * 多维数组合并
 * @param array $array1
 * @param array $array2
 * @return array
 */
function array_merge_multiple(array $array1, array $array2): array
{
    $merge = $array1 + $array2;
    $data = [];
    foreach ($merge as $key => $val) {
        if (
            isset($array1[$key])
            && is_array($array1[$key])
            && isset($array2[$key])
            && is_array($array2[$key])
        ) {
            $data[$key] = is_assoc($array1[$key]) ? array_merge_multiple($array1[$key], $array2[$key]) : $array2[$key];
        } else {
            $data[$key] = $array2[$key] ?? $array1[$key];
        }
    }
    return $data;
}

/**
 * 判断是否为自定义索引数组
 * @param array $array
 * @return bool
 */
function is_assoc(array $array): bool
{
    if (empty($array)) {
        return false;
    }

    return array_keys($array) !== range(0, count($array) - 1);
}

/**
 * 二维数组排序
 * @param $arr
 * @param $keys
 * @param bool $desc
 * @return array
 */
function array_sort($arr, $keys, bool $desc = false): array
{
    $key_value = $new_array = array();
    foreach ($arr as $k => $v) {
        $key_value[$k] = $v[$keys];
    }
    if ($desc) {
        arsort($key_value);
    } else {
        asort($key_value);
    }
    reset($key_value);
    foreach ($key_value as $k => $v) {
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}

/**
 * 隐藏敏感字符
 * @param string $value
 * @return string
 */
function substr_cut(string $value): string
{
    $strlen = mb_strlen($value, 'utf-8');
    if ($strlen <= 1) {
        return $value;
    }

    $firstStr = mb_substr($value, 0, 1, 'utf-8');
    $lastStr = mb_substr($value, -1, 1, 'utf-8');
    return $strlen == 2 ? $firstStr . str_repeat('*', $strlen - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
}

/**
 * 获取当前系统版本号
 * @return mixed|null
 * @throws Exception
 */
function get_version()
{
    static $version = [];
    if (!empty($version)) {
        return $version['version'];
    }
    // 读取version.json文件
    $file = root_path() . '/version.json';
    if (!file_exists($file)) {
        throw new Exception('version.json not found');
    }
    // 解析json数据
    $version = helper::jsonDecode(file_get_contents($file));
    if (!is_array($version)) {
        throw new Exception('version cannot be decoded');
    }
    return $version['version'];
}

/**
 * 获取全局唯一标识符
 * @param bool $trim
 * @return string
 */
function get_guid_v4(bool $trim = true): string
{
    // Windows
    if (function_exists('com_create_guid') === true) {
        $charid = com_create_guid();
        return $trim == true ? trim($charid, '{}') : $charid;
    }
    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    // Fallback (PHP 4.2+)
    mt_srand(intval((double) microtime() * 10000));
    $charid = strtolower(md5(uniqid((string) rand(), true)));
    $hyphen = chr(45); // "-"
    $lbrace = $trim ? "" : chr(123); // "{"
    $rbrace = $trim ? "" : chr(125); // "}"
    return $lbrace .
    substr($charid, 0, 8) . $hyphen .
    substr($charid, 8, 4) . $hyphen .
    substr($charid, 12, 4) . $hyphen .
    substr($charid, 16, 4) . $hyphen .
    substr($charid, 20, 12) .
        $rbrace;
}

/**
 * 时间戳转换日期
 * @param int|string $timeStamp 时间戳
 * @param bool $withTime 是否关联时间
 * @return false|string
 */
function format_time($timeStamp, bool $withTime = true)
{
    $format = 'Y-m-d';
    $withTime && $format .= ' H:i:s';
    return $timeStamp ? date($format, $timeStamp) : '';
}

/**
 * 左侧填充0
 * @param $value
 * @param int $padLength
 * @return string
 */
function pad_left($value, int $padLength = 2): string
{
    return \str_pad($value, $padLength, "0", STR_PAD_LEFT);
}

/**
 * 重写trim方法 (解决int类型过滤后后变为string类型)
 * @param $str
 * @return mixed
 */
function my_trim($str)
{
    return is_string($str) ? trim($str) : $str;
}

/**
 * 重写htmlspecialchars方法 (解决int类型过滤后后变为string类型)
 * @param $string
 * @return mixed
 */
function my_htmlspecialchars($string)
{
    return is_string($string) ? htmlspecialchars($string, ENT_COMPAT) : $string;
}

/**
 * 过滤emoji表情
 * @param $text
 * @return null|string|string[]
 */
function filter_emoji($text)
{
    if (!is_string($text)) {
        return $text;
    }
    // 此处的preg_replace用于过滤emoji表情
    // 如需支持emoji表情, 需将mysql的编码改为utf8mb4
    return preg_replace('/[\xf0-\xf7].{3}/', '', $text);
}

/**
 * 根据指定长度截取字符串
 * @param $str
 * @param int $length
 * @return bool|string
 */
function str_substr($str, int $length = 30)
{
    if (strlen($str) > $length) {
        $str = mb_substr($str, 0, $length);
    }
    return $str;
}

/**
 * 结束执行
 */
function app_end()
{
    if (\request()->isCli()) {
        exit(PHP_EOL);
    }
    throw new HttpResponseException(Response::create());
}

/**
 * 当前是否为调试模式
 * @return bool
 */
function is_debug(): bool
{
    return (bool) Env::instance()->get('APP_DEBUG');
}

/**
 * 文本左斜杠转换为右斜杠
 * @param string $string
 * @return mixed
 */
function convert_left_slash(string $string)
{
    return str_replace('\\', '/', $string);
}

/**
 * 隐藏手机号中间四位 13012345678 -> 130****5678
 * @param string $mobile 手机号
 * @return string
 */
function hide_mobile(string $mobile): string
{
    return substr_replace($mobile, '****', 3, 4);
}

/**
 * 获取当前登录的商城ID
 * @return int $storeId
 */
function getStoreId(): int
{
    return 10001;
}


/**
 * @param $url
 * @param array $data
 * @param array $headers
 * @param int $timeout
 * @param string $method
 * @return bool|string
 */
function curlRequest($url, $data = [], $headers = [], $timeout = 10, $method = 'GET')
{
    $curl = curl_init();
    if (!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    if (!empty($data) && 'GET' == $method) {
        $method = 'POST';
    }

    switch ($method) {
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case 'PUT':
            curl_setopt($curl, CURLOPT_PUT, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case 'DELETE':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            break;
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);

    return $output;
}

/**
 * 验证银行卡
 *
 * @param string $cardid 银行卡号
 * @return void 
 */
function checkBankNumber($cardid)
{
    if (empty($cardid)) return false;

    $card = file_get_contents("https://ccdcapi.alipay.com/validateAndCacheCardInfo.json?_input_charset=utf-8&cardNo=" . $cardid . "&cardBinCheck=true");
    $bankCard = json_decode($card, true);

    $bank = array(
        "CDB" => "国家开发银行", "ICBC" => "中国工商银行", "ABC" => "中国农业银行", "BOC" => "中国银行", "CCB" => "中国建设银行", "PSBC" => "中国邮政储蓄银行", "COMM" => "交通银行", "CMB" => "招商银行", "SPDB" => "上海浦东发展银行", "CIB" => "兴业银行", "HXBANK" => "华夏银行", "GDB" => "广东发展银行", "CMBC" => "中国民生银行", "CITIC" => "中信银行", "CEB" => "中国光大银行", "EGBANK" => "恒丰银行", "CZBANK" => "浙商银行", "BOHAIB" => "渤海银行", "SPABANK" => "平安银行", "SHRCB" => "上海农村商业银行", "YXCCB" => "玉溪市商业银行", "YDRCB" => "尧都农商行", "BJBANK" => "北京银行", "SHBANK" => "上海银行", "JSBANK" => "江苏银行", "HZCB" => "杭州银行", "NJCB" => "南京银行", "NBBANK" => "宁波银行", "HSBANK" => "徽商银行", "CSCB" => "长沙银行", "CDCB" => "成都银行", "CQBANK" => "重庆银行", "DLB" => "大连银行", "NCB" => "南昌银行", "FJHXBC" => "福建海峡银行", "HKB" => "汉口银行",
        "WZCB" => "温州银行", "QDCCB" => "青岛银行", "TZCB" => "台州银行", "JXBANK" => "嘉兴银行", "CSRCB" => "常熟农村商业银行", "NHB" => "南海农村信用联社", "CZRCB" => "常州农村信用联社", "H3CB" => "内蒙古银行", "SXCB" => "绍兴银行", "SDEB" => "顺德农商银行", "WJRCB" => "吴江农商银行", "ZBCB" => "齐商银行", "GYCB" => "贵阳市商业银行", "ZYCBANK" => "遵义市商业银行", "HZCCB" => "湖州市商业银行", "DAQINGB" => "龙江银行", "JINCHB" => "晋城银行JCBANK", "ZJTLCB" => "浙江泰隆商业银行", "GDRCC" => "广东省农村信用社联合社", "DRCBCL" => "东莞农村商业银行", "MTBANK" => "浙江民泰商业银行", "GCB" => "广州银行", "LYCB" => "辽阳市商业银行", "JSRCU" => "江苏省农村信用联合社", "LANGFB" => "廊坊银行", "CZCB" => "浙江稠州商业银行", "DYCB" => "德阳商业银行", "JZBANK" => "晋中市商业银行", "BOSZ" => "苏州银行", "GLBANK" => "桂林银行", "URMQCCB" => "乌鲁木齐市商业银行", "CDRCB" => "成都农商银行",
        "ZRCBANK" => "张家港农村商业银行", "BOD" => "东莞银行", "LSBANK" => "莱商银行", "BJRCB" => "北京农村商业银行", "TRCB" => "天津农商银行", "SRBANK" => "上饶银行", "FDB" => "富滇银行", "CRCBANK" => "重庆农村商业银行", "ASCB" => "鞍山银行", "NXBANK" => "宁夏银行", "BHB" => "河北银行", "HRXJB" => "华融湘江银行", "ZGCCB" => "自贡市商业银行", "YNRCC" => "云南省农村信用社", "JLBANK" => "吉林银行", "DYCCB" => "东营市商业银行", "KLB" => "昆仑银行", "ORBANK" => "鄂尔多斯银行", "XTB" => "邢台银行", "JSB" => "晋商银行", "TCCB" => "天津银行", "BOYK" => "营口银行", "JLRCU" => "吉林农信", "SDRCU" => "山东农信", "XABANK" => "西安银行", "HBRCU" => "河北省农村信用社", "NXRCU" => "宁夏黄河农村商业银行", "GZRCU" => "贵州省农村信用社", "FXCB" => "阜新银行", "HBHSBANK" => "湖北银行黄石分行", "ZJNX" => "浙江省农村信用社联合社", "XXBANK" => "新乡银行", "HBYCBANK" => "湖北银行宜昌分行",
        "LSCCB" => "乐山市商业银行", "TCRCB" => "江苏太仓农村商业银行", "BZMD" => "驻马店银行", "GZB" => "赣州银行", "WRCB" => "无锡农村商业银行", "BGB" => "广西北部湾银行", "GRCB" => "广州农商银行", "JRCB" => "江苏江阴农村商业银行", "BOP" => "平顶山银行", "TACCB" => "泰安市商业银行", "CGNB" => "南充市商业银行", "CCQTGB" => "重庆三峡银行", "XLBANK" => "中山小榄村镇银行", "HDBANK" => "邯郸银行", "KORLABANK" => "库尔勒市商业银行", "BOJZ" => "锦州银行", "QLBANK" => "齐鲁银行", "BOQH" => "青海银行", "YQCCB" => "阳泉银行", "SJBANK" => "盛京银行", "FSCB" => "抚顺银行", "ZZBANK" => "郑州银行", "SRCB" => "深圳农村商业银行", "BANKWF" => "潍坊银行", "JJBANK" => "九江银行", "JXRCU" => "江西省农村信用", "HNRCU" => "河南省农村信用", "GSRCU" => "甘肃省农村信用", "SCRCU" => "四川省农村信用", "GXRCU" => "广西省农村信用", "SXRCCU" => "陕西信合", "WHRCB" => "武汉农村商业银行", "YBCCB" => "宜宾市商业银行",
        "KSRB" => "昆山农村商业银行", "SZSBK" => "石嘴山银行", "HSBK" => "衡水银行", "XYBANK" => "信阳银行", "NBYZ" => "鄞州银行", "ZJKCCB" => "张家口市商业银行", "XCYH" => "许昌银行", "JNBANK" => "济宁银行", "CBKF" => "开封市商业银行", "WHCCB" => "威海市商业银行", "HBC" => "湖北银行", "BOCD" => "承德银行", "BODD" => "丹东银行", "JHBANK" => "金华银行", "BOCY" => "朝阳银行", "LSBC" => "临商银行", "BSB" => "包商银行", "LZYH" => "兰州银行", "BOZK" => "周口银行", "DZBANK" => "德州银行", "SCCB" => "三门峡银行", "AYCB" => "安阳银行", "ARCU" => "安徽省农村信用社", "HURCB" => "湖北省农村信用社", "HNRCC" => "湖南省农村信用社", "NYNB" => "广东南粤银行", "LYBANK" => "洛阳银行", "NHQS" => "农信银清算中心", "CBBQS" => "城市商业银行资金清算中心"
    );
    if(isset($bankCard['bank'])){
        return $bank[$bankCard['bank']] ?? '';
    }
    return  '';
}
