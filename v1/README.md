# Version 1

가장 기본적인 형태의 프레임워크입니다.
`/user/login` 과 같은 url요청도 모두 받아와 처리할 수 있습니다.
`/userpage/2` 와 같은 url요청도 물론 가능합니다.

- `App/index.php` 에서 헬퍼함수를 지정합니다.
- `App/Http/web.php` 에서 모든 기능을 수행합니다.
- `App/Bundle/route.php` 에서 라우팅을 합니다.
- `App/Model` 에서 Model의 역할을 수행합니다.
- `App/Model/_base.php` 에서 DB를 연결해줍니다.
- DB를 연결해주는 부분, Model은 자신의 입맛대로 작성 해주시면 될 것 같습니다.