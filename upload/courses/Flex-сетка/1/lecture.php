<h4>Лирическое вступление</h4>
<p>Получив в очередной раз кучу вопросов про прототипы на очередном собеседовании, я понял, что слегка подзабыл тонкости работы прототипов, и решил освежить знания. Я наткнулся на кучу статей, которые были написаны либо по наитию автора, как он "чувствует" прототипы, либо статья была про отдельную часть темы и не давала полной картины происходящего. </p>
<p>Оказалось, что есть много неочевидных вещей из старых времён ES5 и даже ES6, о которых я не слышал. А еще оказалось, что вывод консоли браузера может не соответствовать действительности.</p>
<h4>Что такое прототип</h4>
<p>Объект в JS имеет собственные и унаследованные свойства, например, в этом коде:</p>
<div class="console">
	<p class="console-text">var foo = { bar: 1 };</p>
	<p class="console-text">foo.bar === 1 // true</p>
	<p class="console-text">typeof foo.toString === "function" // true</p>
</div>
<p>у объекта foo имеется собственное свойство bar со значением 1, но также имеются и другие свойства, такие как toString. Чтобы понять, как объект foo получает новое свойство toString, посмотрим на то, из чего состоит объект.</p>
<p>Дело в том, что у объекта есть ссылка на другой объект-прототип. При доступе к полю foo.toString сначала выполняется поиск такого свойства у самого объекта, а потом у его прототипа, прототипа его прототипа, и так пока цепочка прототипов не закончится. Это похоже на односвязный список объектов, где поочередно проверяется объект и его объекты-прототипы. Так реализовано наследование свойств, например, у (почти, но об этом позже) любого объекта есть методы valueOf и toString.</p>
<h4>Как выглядит прототип</h4>
<p>У всех прототипов имеются два общих свойства, constructor и __proto__. Свойство constructor указывает на функцию-конструктор, с помощью которой создавался объект, а свойство __proto__ указывает на следующий прототип в цепочке (либо null, если это последний прототип). Остальные свойства доступны через ., как в примере выше.</p>
<h4>Да кто такой этот ваш constructor</h4>
<p>constructor – это ссылка на функцию, с помощью которой был создан объект: </p>
<div class="console">
	<p class="console-text">const a = {};</p>
	<p class="console-text">a.constructor === Object // true</p>
</div>
<p>Не совсем понятна идея зачем он был нужен, возможно, как способ клонирования объекта: </p>
<div class="console">
	<p class="console-text">object.constructor(object.arg)</p>
</div>
<p>Но я не нашел подходящий пример его использования, если у Вас есть примеры проектов, где это использовалось, то напишите об этом. В остальном же использовать constructor лучше не стоит, так как это writable свойство, которое можно случайно перезаписать, работая с прототипом, и сломать часть логики.</p>
<h4>Где живёт прототип </h4>
<p>На самом деле, объекты представляют собой не только поля, доступные для JS кода. Интерпретатор также сохраняет некоторые приватные данные объекта для работы с ним, для этого в стандарте определено понятие внутренних слотов, которые обозначены как имя в квадратных скобках [[SlotName]]. Для прототипов отведен приватный слот [[Prototype]] содержащий ссылку на объект-прототип (либо null, если прототипа нет).</p>
<p>Из-за того, что [[Prototype]] предназначался исключительно для самого JS движка, получить доступ к прототипу объекта было невозможно. Для случаев когда это было нужно, ввели нестандартное свойство __proto__, которое поддержали многие браузеры и которое по итогу попало в сам стандарт, но как опциональное и стандартизированное только для обратной совместимости с существующим JS кодом.</p>
<h4>О чем вам недоговаривает дебаггер, или он вам не прототип</h4>
<p>Свойство __proto__ является геттером и сеттером для внутреннего слота [[Prototype]] и находится в Object.prototype:</p>
<p>Из-за этого я избегал записи __proto__ для обозначения прототипа. __proto__ находится не в самом объекте, что приводит к неожиданным результатам. Для демонстрации попробуем через __proto__ удалить прототип объекта и затем восстановить его:</p>
<div class="console">
	<p class="console-text">const foo = {};</p>
	<p class="console-text">foo.toString(); // метод toString() берется из Object.prototype и вернет '[object Object]', пока все хорошо</p>
</div>