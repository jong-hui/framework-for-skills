# Version 2


가장 기본적인 형태에서 라우트, \_base.php 기능을 추가한 프레임워크입니다. 

`/user/login` 과 같은 url요청도 모두 받아와 처리할 수 있습니다. 

`/userpage/2` 와 같은 url요청도 물론 가능합니다.


- `App/index.php` 에서 헬퍼함수를 지정합니다.
- `App/Http/web.php` 에서 모든 기능을 수행합니다.
- `App/Http/web.php` 에서 모델 타입힌트를 사용하여 의존성 주입이 가능합니다.
- `App/Bundle/route.php` 에서 라우팅을 합니다.
- `App/Model` 에서 Model의 역할을 수행합니다.
- `App/Model/_base.php` 에서 DB를 연결해줍니다.
- DB를 연결해주는 부분, Model은 자신의 입맛대로 작성 해주시면 될 것 같습니다.


<http://php.net/manual/en/class.reflectionfunction.php> 

<http://php.net/manual/en/reflectionparameter.gettype.php> 

<https://github.com/laravel/framework/blob/5.3/src/Illuminate/Container/Container.php#L740> 

<https://www.lesstif.com/pages/viewpage.action?pageId=26083754> 

<https://blog.decorus.io/php/2018/07/04/laravel-dependency-injection-container.html> 

<https://wiki.modernpug.org/display/LAR/questions/5506499/answers/5506524> 

<https://laravel.kr/docs/5.7/container#%EC%9D%98%EC%A1%B4%EC%84%B1%20%ED%95%B4%EA%B2%B0> 

<http://www.bmlee.com/%EB%A7%88%EC%A0%A0%ED%86%A02-%EC%9D%98%EC%A1%B4%EC%84%B1-%EC%A3%BC%EC%9E%85-dependency-injection/>