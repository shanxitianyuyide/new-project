<?php
date_default_timezone_get('PRC');

//单例模式  应用于数据库设计类，只连一次数据库
class Datebase
{
    //私有的静态属性来保存类实例
    private static $link;

    //private 和 protect 构造方法不能被实例化
    private function __construct()
    {
    }

    //防止他人克隆，空的私有__clone()
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    //公开的静态的方法访问实例
    public static function getInstance()
    {
//        if (!(self::$instance instanceof Datebase)) {
//            self::$instance = new self();
//        }
//        return 'yes';

        if (isset(self::$link) && self::$link) {
            return self::$link;
        } else {
            self::$link = mysqli_connect('127.0.0.1', 'root', 'root', 'test');
            return self::$link;
        }
    }
}
$a = Datebase::getInstance();
var_dump($a);
echo '<br>';

//工厂设计模式   根据传参不同进行不同的实例化类    mvc框架中数据库操作类  Db类
/**
 * Interface InterfaceShape
 */
interface InterfaceShape
{
    public function getArea();
    public function getCircumference();
}

/*
 * 矩形
 */
class Rectangle implements InterfaceShape
{
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getArea()
    {
        // TODO: Implement getArea() method.
        echo 111;
        return $this->width * $this->height;
    }

    public function getCircumference()
    {
        // TODO: Implement getCircumference() method.
        return 2 * $this->width + 2 * $this->height;
    }
}

class Circle implements InterfaceShape
{
    private $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function getArea()
    {
        // TODO: Implement getArea() method.
        return pow($this->radius, 2) * pi();
    }

    public function getCircumference()
    {
        // TODO: Implement getCircumference() method.
        return 2 * pi() * $this->radius;
    }
}


class FactoryShape
{
    public static function create()
    {
        switch (func_num_args()) {
            case 1:
                return new Circle(func_get_arg(0));
            case 2:
                $rectangle = new Rectangle(func_get_arg(0), func_get_arg(1));
                return $rectangle->getArea();
            default:
                break;
        }
    }
}

$res = FactoryShape::create(5,4);
var_dump($res);
echo '<br>';


/**
 * 观察者模式
 * 场景描述
 * 以购物为核心业务，购物成功后会有短信通知、赠送抵扣券、记录日志、其他活动等
 */

/*
 * 观察者接口
 */
interface TicketObserver
{
    //得到通知后调用的方法
    public function onBuyTicketOver($sender, $args);

}

/**
 * 被观察者接口
 */
interface TicketObservable
{
    //添加观察者
    public function addObserver($observer);
}

/**
 * 被观察者 （购票）
 */
class BuyTicketObservable implements TicketObservable
{
    //通知数组（观察者）
    protected $observers = [];

    //添加多个观察者
    public function addObserver($observer)
    {
        // TODO: Implement addObserver() method.
        $this->observers[] = $observer;
    }

    //购票流程
    public function buyTicket($ticket)
    {
        foreach ($this->observers as $k => $v) {
            $v->onBuyTicketOver($this, $ticket);
        }
    }
}

//短息通知
class Msm implements TicketObserver
{
    public function onBuyTicketOver($sender, $args)
    {
        // TODO: Implement onBuyTicketOver() method.
        echo (date('Y-m-d H：i:s') . '短信日志记录：购票成功：' . $args . '<br>');
    }
}

//文本日志通知
class Txt implements TicketObserver
{
    public function onBuyTicketOver($sender, $args)
    {
        // TODO: Implement onBuyTicketOver() method.
        echo (date('Y-m-d H：i:s') . '文本日志记录：购票成功：' . $args . '<br>');
    }
}

//抵扣券通知
class Dikou implements TicketObserver
{
    public function onBuyTicketOver($sender, $args)
    {
        // TODO: Implement onBuyTicketOver() method.
        echo (date('Y-m-d H：i:s') . '赠送抵扣券：购票成功：' . $args . '赠送10元抵扣卷1张。<br>');
    }
}

$buyTicket = new BuyTicketObservable();

//添加观察者
$buyTicket->addObserver(new Msm());
$buyTicket->addObserver(new Txt());
$buyTicket->addObserver(new Dikou());

//购票
$buyTicket->buyTicket('一排一号');


/**
 * 适配器模式
 * 一个接口，多个类实现适配正常工作
 */
interface IDatabase
{
    //数据库链接方法
    public function connect($host, $username, $password, $database);
    //sql查询方法
    public function query($sql);
    //关闭数据库
    public function close();
}

/**
 * Class Mysql 适配器
 */
class Mysql implements IDatabase
{
    protected $connect;
    //实现链接方法
    public function connect($host, $username, $password, $database)
    {
        // TODO: Implement connect() method.
        $connect = mysql_connect($host, $username, $password);
        mysql_select_db($database);
        $this->connect = $connect;
    }

    //实现查询方法
    public function query($sql)
    {
        // TODO: Implement query() method.
        return mysql_query($sql);
    }

    //实现关闭方法
    public function close()
    {
        // TODO: Implement close() method.
        mysql_close();
    }
}

class mysql_i implements IDatabase
{
    protected $link;

    public function connect($host, $username, $password, $database)
    {
        // TODO: Implement connect() method.
        $this->link = mysqli_connect($host, $username, $password, $database);
        return $this->link;
    }

    public function query($sql)
    {
        // TODO: Implement query() method.
        return mysqli_query($this->link, $sql);
    }

    public function close()
    {
        // TODO: Implement close() method.
        mysqli_close($this->link);
    }
}

$host = '127.0.0.1';
$username = 'root';
$password = 'root';
$database = 'test';

$mysqli = new mysql_i();
$mysqli->connect($host, $username, $password, $database);
$sql = 'insert into user (name, age) values ("test", 12)';
//$sql = 'select * from user';
$res = $mysqli->query($sql);
var_dump(mysqli_fetch_array($res));
$mysqli->close();

/**
 * psr规范
 * psr-1  基本代码规范
 * psr-2  编码规范
 * psr-3  日志接口规范
 * psr-4  自动加载规范
 *
 * 静态调用和实例化的区别：静态调用不能用$this;类名::方法名调用； 实例化产生对象，静态方法可以用对象调用。
 *
 * 数据库三大范式
 * 1、属性不可分割，表中每个字段是不可再拆分的
 * 2、表中要有主键，主键约束
 * 3、表中不能有其他表中存在的、存储信息相同的字段，往往是通过外键建立联系
 *
 *
 * 复合索引：一个索引包含多个字段；遵循最左前缀查询
 * 索引覆盖：查询的字段被所使用的索引覆盖
 *
 *
 * http和https的区别
 *http是超文本传输协议，是以明文方式发送信息的；https是具有安全性的ssl加密传输协议
 *http和https使用的是完全不同的链接方式，使用的端口也不一样，http是80端口，https是443端口
 *http的链接是无状态的（数据包的发送、传输、接受都是相互独立的）；https协议是由ssl+http协议构建的可进行加密传输、身份认证的网络协议，比http安全
 */










