<h4>Разбираемся с промисами в JavaScript</h4>
<p>JavaScript — это однопоточный язык программирования, это означает, что за раз может быть выполнено что-то одно. До ES6 мы использовали обратные вызовы, чтобы управлять асинхронными задачами, такими как сетевой запрос.</p>
<p>Используя промисы, мы можем избегать “ад обратных вызовов” и сделать наш код чище, более читабельным и более простым для понимания.</p>
<p>Предположим, что мы хотим асинхронно получить некоторые данные с сервера, используя обратные вызовы мы сделали бы что-то вроде этого:</p>
<div class="console">
	<p class="console-text">getData(function(x){</p>
	<p class="console-text tab">console.log(x);</p>
	<p class="console-text tab">getMoreData(x, function(y){</p>
	<p class="console-text tab-t">console.log(y);</p>
	<p class="console-text tab-t">getSomeMoreData(y, function(z){</p>
	<p class="console-text tab-3">console.log(z);</p>
	<p class="console-text tab-t">});</p>
	<p class="console-text tab">});</p>
	<p class="console-text">});</p>
</div>
<p>Здесь я запрашиваю некоторые данные с сервера при помощи функции getData(), которая получает данные внутри функции обратного вызова. Внутри функции обратного вызова я запрашиваю дополнительные данные при помощи вызова функции getMoreData(), передавая предыдущие данные как аргумент и так далее.</p>
<p>Это то, что мы называем “адом обратных вызовов”, где каждый обратный вызов вложен внутрь другого, и каждый внутренний обратный вызов зависит от его родителя.</p>
<p>Мы можем переписать приведенный выше фрагмент используя промисы:</p>
<div class="console">
	<p class="console-text">getData()</p>
	<p class="console-text tab">.then((x) => {</p>
	<p class="console-text tab-t">console.log(x);</p>
	<p class="console-text tab-t">return getMoreData(x);</p>
	<p class="console-text tab">})</p>
	<p class="console-text tab">.then((x) => {</p>
	<p class="console-text tab-t">console.log(y);</p>
	<p class="console-text tab-t">return getSomeMoreData(y);</p>
	<p class="console-text tab">})</p>
	<p class="console-text tab">.then((z) => {</p>
	<p class="console-text tab-t">console.log(z);</p>
	<p class="console-text tab">});</p>
</div>
<p>Вы можете видеть, что стало более читабельно, чем в случае первого примера с обратными вызовами.</p>
<h4>Что такое Промисы?</h4>
<p>Промис(Обещание) — это объект который содержит будущее значение асинхронной операции. Например, если вы запрашиваете некоторые данные с сервера, промис обещает нам получить эти данные, которые мы сможем использовать в будущем.</p>
<img src="./upload/courses/Вэб-разработка сложных Api/5/img-lecture/img-1.png" alt="">
<p>Прежде чем погрузиться во все эти технические штуки, давайте разберемся с терминологией промисов.</p>
<h4>Состояния промисов?</h4>
<p>Промис в JavaScript, как и обещание в реальной жизни, имеет 3 состояния. Это может быть 1) нерешенный(в ожидании), 2) решенный/resolved (выполненный) или 3) отклоненный/rejected.</p>
<p>Нерешенный или Ожидающий — Промис ожидает, если результат не готов. То есть, ожидает завершение чего-либо(например, завершения асинхронной операции).</p>
<p>Решенный или Выполненный — Промис решен, если результат доступен. То есть, что-то завершило свое выполнение(например, асинхронная операция) и все прошло хорошо.</p>
<p>Отклоненный — Промиc отклонен, если произошла ошибка в процессе выполнения.</p>
<p>Теперь мы знаем, что такое Промис и его терминологию, давайте вернемся назад к практической части промисов.</p>
<h4>Создаем Промис</h4>
<p>В большинстве случаев вы будете просто использовать промисы, а не создавать их, но все же важно знать как они создаются.</p>
<p>Синтаксис:</p>
<div class="console">
	<p class="console-text">const promise = new Promise((resolve, reject) => {</p>
	<p class="console-text tab">...</p>
	<p class="console-text">});</p>
</div>
<p>Мы создали новый промис, используя конструктор Промисов, он принимает один аргумент, обратный вызов, также известный как исполнительная функция, которая принимает 2 обратных вызова, resolve и reject.</p>
<p>Исполнительная функция выполняется сразу же после создания промиса. Промис становится выполненным при помощи вызова resolve(), а отклоненным при помощи reject(). Например:</p>
<div class="console">
	<p class="console-text">const promise = new Promise((resolve, reject) => {</p>
	<p class="console-text tab">if (allWentWell) {</p>
	<p class="console-text tab-t">resolve ('Все прошло отлично!');</p>
	<p class="console-text tab">} else {{</p>
	<p class="console-text tab-t">reject ('Что-то пошло не так');</p>
	<p class="console-text tab">}</p>
	<p class="console-text">});</p>
</div>
<p>resolve() и reject() принимают один аргумент, который может быть строкой, числом, логическим выражением, массивом или объектом.</p>
<p>Давайте взглянем на другой пример, чтобы полностью понять как создаются промисы.</p>
<div class="console">
	<p class="console-text">const promise = new Promise((resolve, reject) => {</p>
	<p class="console-text tab">const randomNumber = Math.random();</p>
	<p class="console-text tab">setTimeout(() => {</p>
	<p class="console-text tab-t">if(randomNumber < .6) {</p>
	<p class="console-text tab-3">resolve('Все прошло отлично!');</p>
	<p class="console-text tab-t">} else {{</p>
	<p class="console-text tab-3">reject ('Что-то пошло не так');</p>
	<p class="console-text tab-t">}</p>
	<p class="console-text tab">}, 2000);</p>
	<p class="console-text">});</p>
</div>
<p>Здесь я создал новый промис используя конструктор Промисов. Промис выполняется или отклоняется через 2 секунды после его создания. Промис выполняется, если randomNumber меньше, чем .6 и отклоняется в остальных случаях.</p>
<p>Когда промис был создан, он будет в состоянии ожидания и его значение будет undefined.</p>
<img src="./upload/courses/Вэб-разработка сложных Api/5/img-lecture/img-2.png" alt="">
<p>После 2 секунд таймер заканчивается, промис случайным образом либо выполняется, либо отклоняется, и его значением будет то, которое передано в функцию resolve или reject. Ниже пример двух случаев:</p>
<p>Успешное выполнение:</p>
<img src="./upload/courses/Вэб-разработка сложных Api/5/img-lecture/img-3.png" alt="">
<p>Отклонение промиса:</p>
<img src="./upload/courses/Вэб-разработка сложных Api/5/img-lecture/img-4.png" alt="">
<p>Примечание: Промис может быть выполнен или отклонен только один раз. Дальнейшие вызовы resolve() или reject() никак не повлияют на состояние промиса. Пример:</p>
<div class="console">
	<p class="console-text">const promise = new Promise((resolve, reject) => {</p>
	<p class="console-text tab">resolve('Promise resolved');  // Промис выполнен</p>
	<p class="console-text tab">reject('Promise rejected');   // Промис уже не может быть отклонен</p>
	<p class="console-text">});</p>
</div>
<p>Так как resolve() была вызвана первой, то промис теперь получается статус “выполненный”. Последующий вызов reject() никак не повлияет на состояние промиса.</p>
<h4>Использование Промиса</h4>
<p>Теперь мы знаем как создавать промисы, давайте теперь разберемся как применять уже созданный промис. Мы используем промисы при помощи методов then() и catch().</p>
<p>Например, запрос данных из API при помощи fetch, которая возвращает промис.</p>
<p>.then() синтаксис: promise.then(successCallback, failureCallback)</p>
<p>successCallback вызывается, если промис был успешно выполнен. Принимает один аргумент, который является значением переданным в resolve().</p>
<p>failureCallback вызывается, если промис был отклонен. Принимает один аргумент, который является значением преданным в reject().</p>
<p>Пример:</p>
<div class="console">
	<p class="console-text">const promise = new Promise((resolve, reject) => {</p>
	<p class="console-text tab">const randomNumber = Math.random();</p>
	<p></p>
	<p class="console-text tab">if(randomNumber < .7) {</p>
	<p class="console-text tab-t">resolve('Все прошло отлично!');</p>
	<p class="console-text tab">} else {</p>
	<p class="console-text tab-t">reject(new Error('Что-то пошло не так'));</p>
	<p class="console-text tab">}</p>
	<p class="console-text">});</p>
</div>



