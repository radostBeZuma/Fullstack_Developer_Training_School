<h4>Замыкания в JavaScript</h4>
<p>Если вы используете JavaScript, но при этом так до конца и не разобрались, что же это за чудная штука такая — замыкания, и зачем она нужна — эта статья для вас.</p>
<p>Как известно, в JavaScript областью видимости локальных переменных (объявляемых словом var) является тело функции, внутри которой они определены.</p>
<p>Если вы объявляете функцию внутри другой функции, первая получает доступ к переменным и аргументам последней:</p>
<div class="console">
	<p class="console-text">function outerFn(myArg) {</p>
	<p class="console-text tab">var myVar;</p>
	<p class="console-text tab"> function innerFn() {</p>
	<p class="console-text tab-t"> //имеет доступ к myVar и myArg </p>
	<p class="console-text tab">}</p>
	<p class="console-text">}</p>
</div>
<p>При этом, такие переменные продолжают существовать и остаются доступными внутренней функцией даже после того, как внешняя функция, в которой они определены, была исполнена.</p>
<p>Рассмотрим пример — функцию, возвращающую кол-во собственных вызовов:</p>
<div class="console">
	<p class="console-text">function createCounter() {</p>
	<p class="console-text tab">var numberOfCalls = 0;</p>
	<p class="console-text tab">return function() {</p>
	<p class="console-text tab-t">return ++numberOfCalls;</p>
	<p class="console-text tab">}</p>
	<p class="console-text">}</p>
	<p class="console-text">var fn = createCounter();</p>
	<p class="console-text">fn(); //1</p>
	<p class="console-text">fn(); //2</p>
	<p class="console-text">fn(); //3</p>
</div>
<p>В данном примере функция, возвращаемая createCounter, использует переменную numberOfCalls, которая сохраняет нужное значение между ее вызовами (вместо того, чтобы сразу прекратить своё существование с возвратом createCounter).</p>
<p>Именно за эти свойства такие «вложенные» функции в JavaScript называют замыканиями (термином, пришедшим из функциональных языков программирования) — они «замыкают» на себя переменные и аргументы функции, внутри которой определены.</p>
<h4>Применение замыканий</h4>
<p>Упростим немножко пример выше — уберём необходимость отдельно вызывать функцию createCounter, сделав ее аномимной и вызвав сразу же после ее объявления:</p>
<div class="console">
	<p class="console-text">var fn = (function() {</p>
	<p class="console-text tab">var numberOfCalls = 0;</p>
	<p class="console-text tab">return function() {</p>
	<p class="console-text tab-t">return ++numberOfCalls;</p>
	<p class="console-text tab">}</p>
	<p class="console-text">})();</p>
</div>
<p>Такая конструкция позволила нам привязать к функции данные, сохраняющиеся между ее вызовами — это одно из применений замыканий. Иными словами, с помощью них мы можем создавать функции, имеющие своё изменяемое состояние.</p>
<p>Другое хорошее применение замыканий — создание функций, в свою очередь тоже создающих функции — то, что некоторые назвали бы приёмом т.н. метапрограммирования. Например:</p>
<div class="console">
	<p class="console-text">var createHelloFunction = function(name) {</p>
	<p class="console-text tab">return function() {</p>
	<p class="console-text tab-t">alert('Hello, ' + name);</p>
	<p class="console-text tab">}</p>
	<p class="console-text">}</p>
	<p class="console-text">var sayHelloHabrahabr = createHelloFunction('Habrahabr');</p>
	<p class="console-text">sayHelloHabrahabr(); //alerts «Hello, Habrahabr»</p>
</div>
<p>Благодаря замыканию возвращаемая функция «запоминает» параметры, переданные функции создающей, что нам и нужно для подобного рода вещей.</p>
<p>Похожая ситуация возникает, когда мы внутреннюю функцию не возвращаем, а вешаем на какое-либо событие — поскольку событие возникает уже после того, как исполнилась функция, замыкание опять же помогает не потерять переданные при создании обработчика данные.</p>
<p>Рассмотрим чуть более сложный пример — метод, привязывающий функцию к определённому контексту (т.е. объекту, на который в ней будет указывать слово this).</p>
<div class="console">
	<p class="console-text">Function.prototype.bind = function(context) {</p>
	<p class="console-text tab">var fn = this;</p>
	<p class="console-text tab">return function() {</p>
	<p class="console-text tab-t">return fn.apply(context, arguments);</p>
	<p class="console-text tab">}</p>
	<p class="console-text">}</p>
	<p class="console-text">var HelloPage = {</p>
	<p class="console-text tab">name: 'Habrahabr',</p>
	<p class="console-text tab">init: function() {</p>
	<p class="console-text tab-t">alert('Hello, ' + this.name);</p>
	<p class="console-text tab">}</p>
	<p class="console-text">}</p>
	<p class="console-text">//window.onload = HelloPage.init; //алертнул бы undefined, т.к. this указывало бы на window</p>
	<p class="console-text">window.onload = HelloPage.init.bind(HelloPage); //вот теперь всё работает</p>
</div>
<p>В этом примере с помощью замыканий функция, вощвращаемая bind'ом, запоминает в себе начальную функцию и присваиваемый ей контекст.</p>




