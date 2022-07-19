<?php
namespace huanrui\feieyun;
require_once 'HttpClient.class.php';
class Feieyun
{
    private $user;
    private $key;
    private $ip = "api.feieyun.cn"; //接口$this->ip或域名
    private $port = 80; //接口$this->ip端口
    private $path = "/Api/Open/";   //接口路径


    public function __construct($username, $key)
    {
        $this->user = $username;
        $this->key = $key;
    }

    /**
     * [批量添加打印机接口 Open_printerAddlist]
     * @param  [string] $printerContent [打印机的sn#key]
     * @return [string]                 [接口返回值]
     */
    public function printerAddlist($printerContent){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_printerAddlist',
            'printerContent'=>$printerContent
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            $result = $client->getContent();
            return $result;
        }
    }


    /**
     * [打印订单接口 Open_printMsg]
     * @param  [string] $sn      [打印机编号sn]
     * @param  [string] $content [打印内容]
     * @param  [string] $times   [打印联数]
     * @return [string]          [接口返回值]
     */
    public function printMsg($sn,$content,$times){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_printMsg',
            'sn'=>$sn,
            'content'=>$content,
            'times'=>$times//打印次数
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            //服务器返回的JSON字符串，建议要当做日志记录起来
            $result = $client->getContent();
            return $result;
        }
    }

    /**
     * [标签机打印订单接口 Open_printLabelMsg]
     * @param  [string] $sn      [打印机编号sn]
     * @param  [string] $content [打印内容]
     * @param  [string] $times   [打印联数]
     * @return [string]          [接口返回值]
     */
    public function printLabelMsg($sn,$content,$times){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_printLabelMsg',
            'sn'=>$sn,
            'content'=>$content,
            'times'=>$times//打印次数
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            //服务器返回的JSON字符串，建议要当做日志记录起来
            $result = $client->getContent();
            return $result;
        }
    }

    /**
     * [批量删除打印机 Open_printerDelList]
     * @param  [string] $snlist [打印机编号，多台打印机请用减号“-”连接起来]
     * @return [string]         [接口返回值]
     */
    public function printerDelList($snlist){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_printerDelList',
            'snlist'=>$snlist
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            $result = $client->getContent();
            return $result;
        }
    }

    /**
     * [修改打印机信息接口 Open_printerEdit]
     * @param  [string] $sn       [打印机编号]
     * @param  [string] $name     [打印机备注名称]
     * @param  [string] $phonenum [打印机流量卡号码,可以不传参,但是不能为空字符串]
     * @return [string]           [接口返回值]
     */
    public function printerEdit($sn,$name,$phonenum){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_printerEdit',
            'sn'=>$sn,
            'name'=>$name,
            'phonenum'=>$phonenum
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            $result = $client->getContent();
            return $result;
        }
    }


    /**
     * [清空待打印订单接口 Open_delPrinterSqs]
     * @param  [string] $sn [打印机编号]
     * @return [string]     [接口返回值]
     */
    public function delPrinterSqs($sn){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_delPrinterSqs',
            'sn'=>$sn
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            $result = $client->getContent();
            return $result;
        }
    }

    /**
     * [查询订单是否打印成功接口 Open_queryOrderState]
     * @param  [string] $orderid [调用打印机接口成功后,服务器返回的JSON中的编号 例如：123456789_20190919163739_95385649]
     * @return [string]          [接口返回值]
     */
    public function queryOrderState($orderid){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_queryOrderState',
            'orderid'=>$orderid
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            $result = $client->getContent();
            return $result;
        }
    }

    /**
     * [查询指定打印机某天的订单统计数接口 Open_queryOrderInfoByDate]
     * @param  [string] $sn   [打印机的编号]
     * @param  [string] $date [查询日期，格式YY-MM-DD，如：2019-09-20]
     * @return [string]       [接口返回值]
     */
    public function queryOrderInfoByDate($sn,$date){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_queryOrderInfoByDate',
            'sn'=>$sn,
            'date'=>$date
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            $result = $client->getContent();
            return $result;
        }
    }

    /**
     * [获取某台打印机状态接口 Open_queryPrinterStatus]
     * @param  [string] $sn [打印机编号]
     * @return [string]     [接口返回值]
     */
    public function queryPrinterStatus($sn){
        $time = time();         //请求时间
        $msgInfo = array(
            'user'=>$this->user,
            'stime'=>$time,
            'sig'=>$this->signature($time),
            'apiname'=>'Open_queryPrinterStatus',
            'sn'=>$sn
        );
        $client = new HttpClient($this->ip,$this->port);
        if(!$client->post($this->path,$msgInfo)){
            return 'error';
        }else{
            $result = $client->getContent();
            return $result;
        }
    }

    /**
     * [$this->signature 生成签名]
     * @param  [string] $time [当前UNIX时间戳，10位，精确到秒]
     * @return [string]       [接口返回值]
     */
    public function signature($time){
        return sha1($this->user.$this->key.$time);//公共参数，请求公钥
    }
}