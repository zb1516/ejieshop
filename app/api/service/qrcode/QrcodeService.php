<?php

namespace app\api\service\qrcode;

use app\api\model\h5\Setting;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use app\api\model\wxapp\Setting as WxappSettingModel;
use app\common\library\wechat\WxBase;

class QrcodeService
{

    private $cource; //来源 H5 App MP-WEIXIN

    /**
     * 构造方法
     * Driver constructor.
     * @throws Exception
     */
    public function __construct()
    {
        // 实例化当前存储引擎
        $this->cource = getPlatform();
    }
    /**
     * 生成推荐二维码
     *
     * @param [type] $refereeId //邀请人uid
     * @return void
     */
    public function getQrcode($refereeId)
    {        
        switch ($this->cource) {
            case 'H5':
                //H5站点地址
                $h5_url = Setting::getH5Url(10001);
                $content = $h5_url . '/index.html#/pages/login/index&refereeId=' . $refereeId;
                $res = $this->BuildH5Code($content, $refereeId);
                break;
            case 'MP-WEIXIN': //微信小程序
                $res = $this->BuildWxCode($refereeId);
                break;
            default:
                throwError('生成邀请二维码失败', null);
        }
        return $res;

    }
    /**
     * H5生成邀请二维码
     *
     * @return void
     */
    private function BuildH5Code($content, $refereeId)
    {
        if(file_exists(realpath(web_path()) . "/uploads/users/qrcode_h5_" . $refereeId . ".png")){
            return Setting::getH5Url(10001) . "/uploads/users/qrcode_h5_" . $refereeId . ".png";
        }
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create($content)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        // $logo = Logo::create(realpath(web_path()) . '/uploads/users/logo.png')
        //     ->setResizeToWidth(100);

        // Create generic label
        // $label = Label::create('Label')
        //     ->setTextColor(new Color(255, 0, 0));
        $label = null;
        $logo = null;
        $result = $writer->write($qrCode, $logo, $label);
        $result->saveToFile(realpath(web_path()) . "/uploads/users/qrcode_h5_" . $refereeId . ".png");
        return Setting::getH5Url(10001) . "/uploads/users/qrcode_h5_" . $refereeId . ".png";
    }
    /**
     * 微信小程序生成邀请二维码
     *
     * @param [type] $refereeId
     * @return void
     */
    private function BuildWxCode($refereeId)
    {
        if(file_exists(realpath(web_path()) . "/uploads/users/qrcode_wx_" . $refereeId . ".png")){
            return Setting::getH5Url(10001) . "/uploads/users/qrcode_wx_" . $refereeId . ".png";
        }
        // 获取当前小程序信息
        $wxConfig = WxappSettingModel::getWxappConfig();
        $env_version = env('wx.wxmp_env_version');
        $appid  = $wxConfig['app_id'];
        $secret = $wxConfig['app_secret'];
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        $res = file_get_contents($url);
        $res = json_decode($res, 1);
        $codeUrl = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$res['access_token'];
       
        //登录跳转
        $params = [
          "page"=>"pages/index/index",
          "scene"=> $refereeId,
          "env_version" => $env_version
        ];
        $res =  curlRequest($codeUrl, json_encode($params),  [], 10 , 'POST' );
        if(is_array($res) && isset($res['errcode'])){
            throwError('生成邀请二维码失败', null, $res);            
        }
        file_put_contents(realpath(web_path()) . "/uploads/users/qrcode_wx_" . $refereeId . ".png", $res);
        return Setting::getH5Url(10001) . "/uploads/users/qrcode_wx_" . $refereeId . ".png";
        
    }
}
