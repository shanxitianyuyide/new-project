<?php
 $a = '000.000000';
 if ($a == 0) {
     echo 1111;
 }

    /*
     * 抽象类  abstract关键字修饰  抽象类不能被实例化；只能被继承  只能作为其他类的父类使用  抽象类中不一定有抽象方法
     * 子类继承抽象类时，要么实现抽象方法，要么自己被修饰成抽象类
     *
     * 抽象方法   abstract修饰的方法称为抽象方法；有抽象方法的类必须定义为抽象类；抽象方法不能有方法体；抽象方法要被子类实现，不能用private修饰
     */

abstract class People
{
    abstract public function  add();
    public function del(){}
}

class Men extends People
{
    public function __construct()
    {
    }

    public function index()
    {
        echo 111 . '<br>';
    }

    //继承抽象类要实现抽象类中的抽象方法
    public function add()
    {
        // TODO: Implement add() method.
    }
}

$men = new Men();
$men->index();

/*
 * 接口  是特殊的抽象类，也是一个特殊的类，用interface声明
 * 接口实现用implements关键字
 */
interface schoole
{
    public function test();
    public function user();
}

interface middle
{
    public function add();
}

class Student implements schoole,middle
{

    public function index()
    {
        echo 'student class' . '<br>';
    }

    public function test()
    {
        // TODO: Implement test() method.
    }

    public function add()
    {
        // TODO: Implement add() method.
    }
    public function user()
    {
        // TODO: Implement user() method.
    }
}

$student = new Student();
$student->index();

/*
 * 抽象类通过继承extends关键字实现；而接口用implements关键字实现
 * 抽象类中可以有构造方法；但是接口中没有构造方法
 * 一个类只能继承一个抽象类；但是同时可以实现多个接口
 * 抽象类中的方法可以用public、protected、private关键字修饰（抽象方法不能用private），而接口中的方法只能用public关键字修饰
 * 一个类implements一个接口，就必须实现接口中的所有方法；如果继承了一个抽象类，只需要实现所需要的方法即可
 */

/*
 * 事务  四大特性
 * 原子性（不可分割） 一个事务要么全部执行，要么全部不执行
 * 一致性  事务开始之前和事务结束之后，数据库的完整性没有破坏
 * 隔离性  数据库可以同时执行多个事务，但是事务之间互不干扰
 * 持久性  事务处理结束后，对数据的修改时持久的，即便系统故障也不会丢失
 */

/*
 * 索引
 *   普通索引    允许索引列中插入空值和重复值  纯粹为了查询快
 *   唯一索引    索引列必须是唯一的，可以为空值
 *   主键索引    特殊的唯一索引，不允许有空值
 *   组合索引    多个字段建立索引   遵循最左前缀查询
 *   查看是否查询用索引  关键字explain     key 查询所用到的索引    possible_keys 查询时可以选用的各个索引
 */

/**
 * array_pop()  删除数组中的最后一项
 * array_slice(array, start)  从数组中根据条件取出一段值
 * array_search()  从数组中根据值搜索对应的键
 *
 * strpos() 查找字符串在另个字符串中第一次出现的位置   区分大小写
 * stripos()  ------------------------------   不区分大小写
 *
 * strrpos()  查找字符串在另一个字符串中最后一次出现的位置    区分大小写
 * strripos()  -----------------------------------     不区分大小写
 *
 * strrchar()  查找字符串在另一字符串中最后一次出现的位置，返回该位置到字符串结尾的所有字符
 *
 * trim（） 删除字符串两侧的空白字符或预设定的字符
 */

/**
 * cookie禁用了，session不能用 因为session通过sessionId来获取，sessionId存在cookie中
 * 但是可以把sessionId用url参数传递过去就可以用了
 *
 * 104.10684,35.62053
 */

/**
 * Redis 是一款内存高速的缓存数据库
 *
 * redis和memcache比较
 *   redis不仅支持简单的k/v类型的数据，还支持string、list、hash、set、zset数据类型
 *   memcache把数据存储在内存中，断电后会挂掉，数据不能超过内存大小
 *   redis部分数据存在硬盘上，保证数据的持久性，支持数据的持久化
 *
 *   redis支持master-slave(主-从)模型应用
 *
 *   memcache是多线程的，阻塞情况少；redis是单线程的，阻塞情况较多
 *
 *   redis单个value最大限制1GB,memcache只能保存1MB的数据
 */

/**
 * 缓存雪崩   某一段时间，缓存集中过期失效
 *
 * 缓存穿透   查询一个数据库，一定不存在的数据。如果数据库查询对象为空，则不放进缓存
 *
 * 缓存击穿   是指一个key非常热点，在不停地抗着大并发，大并发集中对这一点进行访问，当这个key在失效瞬间，持续的大并发就穿破缓存，直接请求数据库。
 */

/*
 * apache和nginx的核心区别：apache是同步的多进程，一个连接对应一个进程，nginx是异步的，多个请求对应一个进程，进程死了之后影响其他用户。
 */

/**
 * 反向代理    反向代理服务器架设在服务端，通过缓冲经常被请求的页面来缓解服务器的工作量，将客户机请求转发给内部网络上的目标服务器
 *            并将从服务器上得到的结果返回给Internet上请求连接的客户端，此时代理服务器和目标主机一起对外表现为一个服务器
 *
 * 主要应用    防止外网对内网服务器的恶性攻击、缓存以减少服务器的压力和访问安全控制之外，还可以进行
 *            负载均衡，将用户请求分配给多个服务器。
 *
 * nginx   反向代理的服务器
 */

/**
 * sql优化   1、表中建立索引   优先考虑where  group by
 *           2、尽量避免select *
 *           3、尽量避免in或not in    优化：用between代替
 *           4、尽量避免or            优化：union代替
 *           5、尽量避免开头模糊查询（%li%）    优化：尽量在字段后面使用模糊查询（li%）
 *           6、尽量避免用null判断     优化：字段添加默认值0，用0判断
 *           7、尽量避免在SQL中进行表达式计算
 *           8、避免使用where 1=1的条件  优化：用where...and...
 */






