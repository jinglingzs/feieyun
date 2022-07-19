# 基于 飞鹅云开放平台 的 PHP 接口组件

### 安装
`composer require huanrui/feieyun`

### 运行环境

* php >= 5.6
* composer
配置
请先注册 飞鹅云开放平台 账号，获取到相应的用户名和 api key

### 使用

```
use huanrui\feieyun\Feieyun;

/**
* 方法1 批量添加打印机接口
* @return void
  */
  public function testPrinterAddlist()
  {
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //提示：
  //$printerConten => 打印机编号sn(必填) # 打印机识别码key(必填) # 备注名称(选填) # 流量卡号码(选填)
  //多台打印机请换行（\n）添加新打印机信息，每次最多100台。
  $printerContent = "sn1#key1#remark1#carnum1\nsn2#key2#remark2#carnum2";

  $response_data = $feieyun->printerAddlist($printerContent);
  $this->dump($response_data);
  }

/**
* 方法2 小票机打印订单接口
* @param  [string] $sn      [打印机编号sn]
* @param  [string] $content [打印内容]
* @param  [string] $times   [打印联数]
* @return [string]          [接口返回值]
  */
  public function testPrintMsg()
  {
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //标签说明：
  //单标签:
  //"<BR>"为换行,"<CUT>"为切刀指令(主动切纸,仅限切刀打印机使用才有效果)
  //"<LOGO>"为打印LOGO指令(前提是预先在机器内置LOGO图片),"<PLUGIN>"为钱箱或者外置音响指令
  //成对标签：
  //"<CB></CB>"为居中放大一倍,"<B></B>"为放大一倍,"<C></C>"为居中,<L></L>字体变高一倍
  //<W></W>字体变宽一倍,"<QR></QR>"为二维码,"<BOLD></BOLD>"为字体加粗,"<RIGHT></RIGHT>"为右对齐

  $nowTime = date("Y-m-d H:i:s");
  $orderNo = "2207011746450001";
  $phone = "185****9290";
  $orderForm = "省心车主卡";
  $oilNo = "92#";
  $gunNo = "1号枪";
  $priceGun = "10.19";
  $price = "10";
  $units = "0.98";
  $unitPrice = "0.00";
  $qrcode = "http://www.huanrui.net.cn";

  //打印内容
  $content = '<BOLD><CB>智慧油站</CB></BOLD><BR>';
  $content .= '<CB>(收银小票)</CB><BR>';
  $content .= '打印时间: '.$nowTime.'<BR>';
  $content .= '订单编号: '.$orderNo.'<BR>';
  $content .= '交易时间: '.$nowTime.'<BR>';
  $content .= '手机号: '.$phone.'<BR>';
  $content .= '订单来源: '.$orderForm.'<BR>';
  $content .= '--------------------------------<BR>';
  $content .= '油品信息：<BR>';
  $content .= '油号枪号：'.$oilNo.'-'.$gunNo.'<BR>';
  $content .= '油站价格：'.$priceGun.'<BR>';
  $content .= '加油升数：'.$units.'升<BR>';
  $content .= '加油金额：￥'.$price.'元<BR>';
  $content .= '优惠金额：-￥'.$unitPrice.'<BR>';
  $content .= '--------------------------------<BR>';
  $content .= '应收：￥'.$price.'元<BR>';
  $content .= '--------------------------------<BR>';
  $content .= '优惠合计：-￥'.$unitPrice.'元<BR>';
  $content .= '实收金额：￥'.$price.'元<BR><BR><BR>';
  $content .= '--------------------------------<BR>';
  $content .= '车主如需开票,请把下面二维码撕给车主<BR>';
  $content .= '<QR>'.$qrcode.'</QR>';//把二维码字符串用标签套上即可自动生成二维码
  $content .= '<CB>扫码开票</CB><BR>';
  $content .= '1.请在7天内扫码开票<BR>';
  $content .= '2.请勿将含有二维码的小票丢弃于站内<BR>';
  $content .= '<B>谢谢配合,祝您生活愉快!</B><BR>';

  echo($content);die;

  //提示：
  //printSN => 打印机编号
  //$content => 打印内容,不能超过5000字节
  //$times => 打印次数，默认为1。

  $printSN = "sn1";
  $times = 1;
  $response_data = $feieyun->printMsg($printSN,$content,$times);
  $this->dump($response_data);
  }

//方法3 标签机专用打印订单接口  略

/**
* 方法4 批量删除打印机
* @return void
  */
  public function testPrinterDelList(){
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //$snlist => 打印机编号，多台打印机请用减号"-"连接起来。
  $snlist = "123456789";

  $response_data = $feieyun->printerDelList($snlist);
  $this->dump($response_data);
  }

/**
* 方法5 修改打印机信息接口
* @return void
  */
  public function testPrinterEdit(){
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //提示：
  //$printSN => 打印机编号
  //$name => 打印机备注名称
  //$phonenum => 打印机流量卡号码
  $printSN = "sn1";
  $name = "飞鹅云打印机";
  $phonenum = "01234567891011121314";

  $response_data = $feieyun->printerEdit($printSN,$name,$phonenum);
  $this->dump($response_data);
  }

/**
* 方法6 清空待打印订单接口
* @return void
  */
  public function testDelPrinterSqs(){
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //提示：
  //$printSN => 打印机编号
  $printSN = "sn1";

  $response_data = $feieyun->delPrinterSqs($printSN);
  $this->dump($response_data);
  }

/**
* 方法7 查询订单是否打印成功接口
* @return void
  */
  public function testQueryOrderState(){
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //提示：
  //$orderid => 订单ID，由批量添加打印机接口接口Open_printMsg返回。

  $orderid = "123456789_20160823165104_1853029628";//订单ID，从批量添加打印机接口返回值中获取
  $response_data = $feieyun->queryOrderState($orderid);
  $this->dump($response_data);
  }

/**
* 方法8 查询指定打印机某天的订单统计数接口
* @return void
  */
  public function testQueryOrderInfoByDate(){
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //提示：
  //printSN => 打印机编号
  //$date => 查询日期，格式YY-MM-DD，如：2016-09-20

  $printSN = "sn1";
  $date = "2016-09-20";
  $response_data = $feieyun->queryOrderInfoByDate($printSN,$date);

  $this->dump($response_data);
  }

/**
* 法9 获取某台打印机状态接口
* @return void
*/
  public function testQueryPrinterStatus(){
  $username = 'username';
  $key = 'key';
  $feieyun = new Feieyun($username, $key);

  //提示：
  //printSN => 打印机编号
  $printSN = "sn1";
  $response_data = $feieyun->queryPrinterStatus($printSN);

  $this->dump($response_data);
  }

function dump($response_data){
var_dump(json_decode($response_data, JSON_UNESCAPED_UNICODE));
}
```