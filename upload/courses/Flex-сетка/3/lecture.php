<h4>Теория</h4>
<p>В отличие от многих других языков программирования ключевое слово this в javascript не привязывается к объекту, а зависит от контекста вызова. Для упрощения понимания будем рассматривать примеры применительно к браузеру, где глобальным объектом является window.</p>
<h4>Простой вызов функции</h4>
<div class="console">
	<p class="console-text">function f() {</p>
	<p class="console-text tab">console.log(this === window); // true</p>
	<p class="console-text">}</p>
	<p class="console-text">f();</p>
</div>
<p>В данном случае this внутри функции f равен глобальному объекту (например, в браузере это window, в Node.js — global).</p>
<p>Самовызывающиеся функции (self-invoking) работают по точно такому же принципу.</p>
<div class="console">
	<p class="console-text">(function () {</p>
	<p class="console-text tab">console.log(this === window); // true</p>
	<p class="console-text">})();</p>
</div>
<h4>В конструкторе</h4>
<div class="console">
	<p class="console-text">function f() {</p>
	<p class="console-text tab">this.x = 5;</p>
	<p class="console-text tab">console.log(this === window); // false</p>
	<p class="console-text">}</p>
	<p class="console-text">var o = new f();</p>
	<p class="console-text">console.log(o.x === 5); // true</p>
</div>
<p>При вызове функции с использованием ключевого слова new функция выступает в роли конструктора, и в данном случе this указывает на создаваемый объект.</p>
<h4>В методе объекта</h4>
<div class="console">
	<p class="console-text">var o = {</p>
	<p class="console-text tab">f: function() {</p>
	<p class="console-text tab-t">return this;</p>
	<p class="console-text tab">}</p>
	<p class="console-text">}</p>
	<p class="console-text">console.log(o.f() === o); // true</p>
</div>
<p>Если функция запускается как свойство объекта, то в this будет ссылка на этот объект. При этом не имеет значения, откуда данная функция появилась в объекте, главное — как она вызывается, а именно какой объект стоит перед вызовом функции:</p>
<div class="console">
	<p class="console-text">var o = {</p>
	<p class="console-text tab">f: function() {</p>
	<p class="console-text tab-t">return this;</p>
	<p class="console-text tab">}</p>
	<p class="console-text">}</p>
	<p class="console-text">console.log(o.f() === o); // true</p>
	<p class="console-text">console.log(o2.f() === o2);//true</p>
</div>
<h4>Методы apply, call</h4>
<p>Методы apply и call позволяют задать контекст для выполняемой функции. Разница между apply и call — только в способе передачи параметров в функцию. Первый параметр обеих функций определяет контекст выполнения функции (то, чему будет равен this).</p>
<p>Примеры:</p>
<div class="console">
	<p class="console-text">function f() {</p>
	<p class="console-text">}</p>
	<p class="console-text">f.call(window); // this внутри функции f будет ссылаться на объект window</p>
	<p class="console-text">f.call(f); //this внутри f будет ссылаться на f</p>
</div>
<p>Похитрее:</p>
<div class="console">
	<p class="console-text">function f() {</p>
	<p class="console-text tab">console.log(this.toString()); // 123</p>
	<p class="console-text">}</p>
	<p class="console-text">f.call(123); // this внутри функции f будет ссылаться на объект Number со значением 123</p>
</div>
<h4>Разбираем задачу</h4>
<p>Применим полученные знания к приведенной в начале топика задаче. Опять же для упрощения будем рассматривать примеры применительно к браузеру, где глобальным объектом является window.</p>
<h4>f()</h4>
<div class="console">
	<p class="console-text">var f = function() {</p>
	<p class="console-text tab">// Функция f вызывается с помощью простого вызова - f(),</p>
	<p class="console-text tab">// поэтому this ссылается на глобальный объект</p>
	<p class="console-text tab">this.x = 5; // window.x = 5;</p>
	<p></p>
	<p class="console-text tab">// В пункте 1.1 также указано, что в самовызывающихся функциях this также ссылается на глобальный объект</p>
	<p class="console-text tab">(function() {</p>
	<p class="console-text tab-t">this.x = 3;  // window.x = 3</p>
	<p class="console-text tab">})();</p>
	<p class="console-text tab">console.log(this.x); // console.log(window.x)</p>
	<p>};</p>
</div>
<p>Результат: 3</p>

