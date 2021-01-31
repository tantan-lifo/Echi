使用的是tp5.1框架，运行需要**mysql+apache+php**环境
下载后即可通过相应url访问
采用多控制器模式，
但对于本项目来说，代码都在Index控制器下；
首页访问路径：
iner.site/index/user/login.html

- 源码地址：https://github.com/tantan-lifo/Echi

​      访问网址：https://iner.site/index/user/login

- **完整的PHP访问机制**
  **在客户端(浏览器)输入文件进行访问，**
  **按下回车，文件名发给PHP服务器Apache**
  **Apache对请求进行分析，后缀是.php时，发送给PHP引擎，**
  **PHP引擎将解析后的html文件发送给Apache**
  **最后呈现在客户端；**



- Php环境搭建：
  - 手动

  - 集成环境：wampserver等 

    其中mysql如果使用wamp内的，需要在‘服务’打开wampmysqld64

  **wamp报红解决办法：https://blog.csdn.net/Ariel_201311/article/details/100170451**

  （在linux系统中，安装LAMP后，自动对文件解析）

- ThinkPhp的好处：
  - 视图模型：轻松动态地创建数据库视图，多表查询。
     关联模型：简单、灵活的方式完成多表的关联操作。 
  - 扩展机制：系统支持包括类库扩展、驱动扩展、应用扩展、模型扩展、控制器扩展 

- 本项目由ThinkPhp5.1框架开发。结合本项目详细总结下学到的ThinkPhp知识以及对项目的介绍。


官方文档 https://www.kancloud.cn/manual/thinkphp5_1/353946

---------------------------------------------------



基本介绍

- 安装

​		      按部就班

-  项目结构


​		<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612014278084.png" style="zoom:33%;" />

- <img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612014493251.png" alt="1612014493251" style="zoom: 23%;" />



- 目录描述：

  - 1.框架的MVC设计模式，全部在application目录中体现

  - 2.config：框架配置目录，数据库，每个文件对应着一级配置

    ​	其中可以设置前缀  'prefix' => 'tp_',
    ​	设置用户名、密码、库名、表

  - 3.public：对外可访问web目录

  - 4.thinkphp：框架核心目录（尽可能不要修改，以方便框架升级）

  - 5.runtime：运行目录，有日志



- 配置：

  - 多模块/单模块

    设置单模块：
    	通过设置app.php->app_multi_module=false;
    	之后再application目录下直接创建controller；

    在多模块下修改默认访问路径
    	可以只访问一个模块：通过public/index.php添加bind
    	可以设置空模块使得在输入错误时进入指定的模块；注意控制器、操作也要跟着变化!

  - 数据库设置（在model单独设置）

  - 正式/测试   修改app_trace=true/false

    

- application项目结构：
  
  - 控制器名与类名一致

<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612066574581.png" alt="1612066574581" style="zoom:43%;" />			

​	

<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612015346417.png" alt="1612015346417" style="zoom:33%;" />



- url访问模式
      http://localhost/tp5/public/index.php/模块名/控制器名/方法名

     在本例中，hello控制器有hello、hi、test方法

     访问http://localhost/tp5/public/index.php/index/index/hello/name/Lee即得到结果 helloLee

  ----

  

  **数据库配置**

  

<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612016384150.png" alt="1612016384150" style="zoom:33%;" />

端口信息<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612016454529.png" alt="1612016454529" style="zoom:33%;" />

也可以在model里写db_connection

<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612016760262.png" alt="1612016760262" style="zoom: 50%;" />

---------------------------------------



**三种连接数据库的方式**
       （1）不用model；
   1.Db::table('数据表')//加前缀

2. Db::name('user')

   （2）model

3. User::select()//model名

<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612017359165.png" alt="1612017359165" style="zoom:53%;" />

-------

**增删查改：**

（data是存放着表内容的数组）

```php
- 查找
	Db::table('tp_user')->where('id','127')->findOrFail();
	$data = \db('user')->select();
	Db::name('user')->column('username','27');
	$user = Db::name('user');//设置一个model即可使用
  	$data = $user->where('id','27')->find();	
- 插入 
	Db::name('user')->insertAll($data);
- 更新
	在data表中：'email'=> Db::raw('UPPER(email)')    （raw可以方便的更新表）
	Db::name('user')->update($data);
- 删除
	Db::name('user')->delete([233,234,225,235,236,237]);
```

------------------



以上是不使用模型操作数据库，下面介绍模型操作数据库

**命名**
	这里拿model模型举例：
	model模型底下的方法（控制器）是与数据表同名的(去掉前缀)--确切说驼峰式命名法
	比如tp_user则对于User，tp_user_type对应UserType。
	这样设置模型后连接表可以方便采用User::select();(其中User已连接好数据库)

（1）如果担心设置的模型类名和 PHP 关键字冲突，可以开启应用类后缀；
开启方法:在 app.php，设置 class_suffix 属性为 true 即可：'class_suffix' => true

（2）解决重名问题：
先介绍：
	User::中的User是在model\User，我们在控制器中可以直接调用这个方法，但是倘若控制器与User重名：
	使用USer::网页就会不知道如何区分
解决措施：
	引入use app\model\User as modeluser
	这样我们调用时：modeluse::select(); //编辑器就会能区分了

**调用**
    **静态调用/实例化调用**
			// 静态调用
        	$blog = Blog::get(1);//以id为1作为条件(自动根据主键来查)
        	// 实例化模型
       	 $blog = new Blog();
       	 // 使用 Loader 类实例化（单例）
        	$blog = Loader::model('Blog');
        	// 或者使用助手函数`model`
        	$blog = model('Blog');
	 **查询**
	//静态查询
        $blog = Blog::get(2);//以id为1作为条件(自动根据主键来查)
        echo $blog->title;//输出：php实战

​    **多条件查询**
​    $bolg = Blog::get(['title'=>'模型1','content'=>'模型内容2']);
​    $bolg = Blog::where(['title'=>'模型1','content'=>'模型内容2'])->find();
​    echo $bolg->id;
​    //查询全部
​    $bolg = Blog::all();
​    foreach($bolg as $key=>$v){ echo $v->title."<br>"; }
   **动态查询**  (根据某个条件查询数据 getByxxx()方法(xxx是字段名字；驼峰法))
​	$bolg = Blog::getByTitle('模型1');
​	echo $bolg->content;

详见 https://blog.csdn.net/xgx198831/article/details/104996881

-------------------

字符集命名规则：utf8mb4;      

排序规则：utf8mb4_general_ci

路由是对url的自定义

使用model
	1.使用控制类User::对数据库简便操作时需要在model继承Model类！！
	2.在.html里url的书写：action="{:url('index/login/login')}

----------

后台管理系统
	背景：
		无论后台、前台都有模板（负责页面相关设计，使得后台管理可视）；
		每一个小工程底下都有MVC模式，本次模板放置view里
		view：
			文件以方法命名；底下存放的.html可以自定义（但需要在方法中使用'return view()'）
			在中文网项目下载使用后index.html有bug->只能替换新文件（文本是对的）
	模板：H-UI
			public/static: static->css样式 lib->第三方插件

```php
Base.php继承Controller，其他控制器只要继承它，就可以使用其下所有方法
初始化initialize:初始化Session，用户登录就可以获得session值，重复登陆或者未登录就根据session判断。
    
class Base extends Controller
{
    protected function initialize()
    {
        //继承了Base的控制器会直接调用本条操作(初始化)
        //给user_id值
        parent::initialize();

        define('USER_ID', Session::has('user_id') ? Session::get('user_id'):null);
        //define('user','name');
    }

    //判断用户是否登陆,放在系统后台入口前面: index/index
    protected function isLogin()
    {
        if (is_null(USER_ID)) { //null即true

            $this -> error('用户未登陆,无权访问',url('user/login'));
            
        }
    }

    //防止用户重复登陆,放在登陆操作前面:user/login
    protected function alreadyLogin(){
        if (!is_null(USER_ID)) {
            $this -> error('用户已经登陆,请勿重复登陆',url('index/index'));
        }
    }
}
```



```php
index.php
    继承base，调用isLogin方法
public function index()//判断是否用户登录
    {
        $this -> isLogin();
    //如果isLogin无返回，return view
        return view();
    }
```



```php
接收前端传来的数据，并进行规则验证，符合规矩写入数据表
    
public function index()
    {
        /*$view = new view();
        return $view->fetch('index');*/
        return view('index');
    }
    public function regist(){
        //实例化User
        $user = new User();
        //接收前端表单提交的数据
        $user->name = input('post.name');

        $user->password = input('post.password');
//进行规则验证
        $result = $this->validate(
            [
                'name' => $user->name,

                'password' => $user->password,
            ],
            [
                'name' => 'require|max:10',

                'password' => 'require',
            ]);
        if (true !== $result) {
            $this->error($result);
        }
        //写入数据库
        if ($user->save()) {
            return $this->success('注册成功！','app/index/index/index');
        } else {
            return $this->success('注册失败');
        }
    }
```

​	

```php
登陆检查：$msg会对输入的错误相应提示
如果输入合法，再看数据库有没有该用户  UserModel::get($map)==null;
并且放置session
public function checkLogin(Request $request)
    {
        //初始返回参数
        $status = 0;
        $result = '';
        $data = $request -> param();

        $rule = [
            'name|姓名' => 'require',
            'password|密码' => 'require',
            'verify|验证码' => 'require|captcha',
        ];
        $msg = [
            'name' => ['require'=>'用户名不能为空，请检查'],
            'password' => ['require'=> '密码不能为空，请检查'],
            'verify' => [
                'require'=>'验证码不能为空，请检查',
                'captcha'=>'验证码错误'
            ],
        ];

        $result = $this -> validate($data,$rule,$msg);
        //return ['status'=>$status, 'message'=>$result,'data'=>$data];
        if(true === $result){
            $map = [
                'name' => $data['name'],
                'password' => $data['password']
            ];

            //查询用户信息
            $user = UserModel::get($map);
            if(null === $user){
                $result = '没有该用户,请检查';
            }else{
                $status = 1;
                $result = '验证通过，点击[确定]进入';
            //设置用户登录信息用session
                /*Session::set('user_id',$user['id']);
                Session::set('user_info.name',$user['name']);*/
                //放置session
                Session::set('user_id',$user->id);
                Session::set('user_info',$user->getData());
            }


        }
        return ['status'=>$status, 'message'=>$result, 'data'=>$data];

    }
```

**View层**

**模板的分离**：
		把各个不同区域的模板分离到不同的文件，使用<include file="public/meta" />引用

**父模板重写、子模板继承：**
	   在public目录下新建父类base.html；将index.html内容复制:
			1.将一些公共模块保留，用<block name="">功能说明</block>
			index.html重写：
		    2.顶部引用{extend name="public/base" /}
		    3.在css区块外加上<block name=""></block>
	         其实两个目录有点像；而且注意子目录只能有extend、block

<img src="C:\Users\谭\AppData\Roaming\Typora\typora-user-images\1612071128459.png" alt="1612071128459" style="zoom:50%;" />

**小结**：公共模板的导入、文件的分离、模板继承
	其中模板导入到public/static；
	我们会写一个index.html(包含各种页面)，放在视图view中，具体位置index文件夹下；
	所谓文件分离就是把index.html各个模块分离到view/public(若没有，新建)下的不同html中；
	最后我们修改index.html->继承base.html父类(base引用各大分离出来的模板文件)
	达到简化明了的效果

----

小结到目前为止的代码

1.index/user 简单注册
2.regist/regist、login 有样式的登录注册
	(都是index方法有用)
3.index/index 前台模板
4.index/user/login 后台(有样式)登陆
5.加载模板
6.渲染：加载css样式

7.写登陆模块的小功能：
index/user/checklogin；

-------------



AJAX提交表单分为两种
　1、无返回结果的，就是把表单数据直接提交给后台，让后台直接处理；
　最简单的就是$(“#formid”).submit();直接将form表单提交到后台。

　2、返回有结果的，这种情况下，后台不管是执行成功还是失败，最终的信息都需要返回到前台。
  第二种是使用最多的一种，因为程序的执行成功与否都需要给用户提示，程序一般也都是多步完成的，执行完插入操作，需要发起流程，这就需要在界面上判断成功与否。ajax本身属于有返回结果的一类，其中的success方法就是处理后台返回结果的

有序列化的ajax表单提交法(将form表单序列化)

```php
<span style="font-size:18px;">  
$.ajax({  
    type: "POST",  
    url:your-url,  
    data:$('#yourformid').serialize(),  
    async: false,  
    error: function(request) {  
        alert("Connection error");  
    },  
    success: function(data) {  
        //接收后台返回的结果  
    }  
  });</span>
```

通过窗口查找查找form表单提交
当使用弹窗按钮提交表单时与前者不同，
	

```php
<span style="font-size:18px;">  // 提交表单  
	  var obj = document.getElementById("xx_iframe").contentWindow;  
	  obj.$("#yourform").form("submit",{  
	    success :function(data){  
		//对结果处理  
	    }    
	  });</span>
```

```javascript
<!--Ajax提交脚本-->
<script>
	$(function (){
		//给登陆按钮添加点击事件
		$('#login').on('click',function() {
			$.ajax({
				type: 'POST',					//提交方式为POST
				url: "{:url('checkLogin')}",	//设置提交数剧处理的脚本文件的地址
				data:$('form').serialize(),	//将当前的表单数据序列化后再提交
				dataType: 'json',  			//设置提交数据的类型为json
				success: function (data) {
					if(data.status==1){
						alert(data.message);
						window.location.href="{:url('index/index/index')}";
					} else {
						alert(data.message);
					}
				}
			});
		})
	})
</script>
```

项目的理解：
	对login.html简单的理解
	27-64 三个框的样式：对账户、密码、验证码样式等的说明
	65 样底
	67、68 js变化
	69 ajax表单
	91 刷新验证码

·	ajax提交表单那段：通过验证方法后，url跳转到index/index
通过http://localhost/tp5.1/public/index/user/login访问

```javascript
ts为随机时间函数
图片来自Tp自带的组件，通过时间函数刷新
<!--刷新验证码的脚本-->
<script>
	function refreshVerity(){
		//ob_clean();
		var ts = Date.parse(new Date())/1000;
		//captcha是图片组件
		$("#verity_img").attr("src" , "/index.php/captcha?id="+ts);//刷新验证码
	}
	
</script>
```


数据问题(如果对输入的密码有md加密，那么数据库也必须有相应的解析)





错误小结：
	第一次错误点击没反应是数据库名错误(连接不上)
	第二次错误登录后显示没有这个用户是对密码加密了

将代码上传到云服务器

1.访问 http://182.92.59.131:99/regist/login/index 出现错误：file_put_contents( runtime/temp/
解决措施：修改runtime权限为775
并且regist控制器下的都可以访问

2.http://182.92.59.131:99/admin/data_test/select 成功访问


3.访问 http://182.92.59.131:99/index/index/index.html 成功 -> 修改namespace下的命名(大写改成小写、Facade->facade)
