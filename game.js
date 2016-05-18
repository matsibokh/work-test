function game(){

	var cellView = null;
	var numView = null;
	var clicks = 3;
		
	//оголошуємо змінні 
	//створюємо масив зі значеннями
	var size=100;
	var arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,0];
	var clicks=0;
	var e = [[0,1,2,3],[4,5,6,7],[8,9,10,11],[12,13,14,15]];

	//малюємо доску
	var bord = document.getElementById("bord"),
	ctx  = bord.getContext('2d');
	ctx.fillRect(0, 0, bord.width, bord.height);
	
	//рахуємо кліки
	this.onclick=function(){
		clicks++;
		return (clicks-1);
	};
				
	//малюємо ячейки
	this.draw=function(){
		for(var i=0; i<4; i++){
			for(var j=0; j<4; j++){
				ctx.fillStyle="#9400D3";
				ctx.fillRect(i*size,j*size,99,99);
			}
		}
	};

	//підписyємо значення ячейок, якщо 0 тоді пусте поле
	this.write=function(){
	//для початку пишемо ф-цію для рамдомного перемішання цифр в масиві
		function getRandom(a,b){
			return Math.random()-0.5;
		}
		// якщо ще не було кліків по дошці - перемішуємо дані в масиві
		
		arr1=arr.sort(getRandom);
		var n=-1;
		for(var i=0; i<4; i++){
			for(var j=0; j<4; j++){
				n++
				ctx.fillStyle="#EED5B7";
				ctx.font = "italic bold 48px sans-serif";
				ctx.fillText(arr1[n], i * size + size / 4, j * size + size / 1.5);
							
				if(arr1[n]===0){
					ctx.fillStyle="black";
					ctx.fillRect(i*size,j*size,99,99);
					var nu=n;
				}	
			}
		}
	};

	// дана ф-ція повертає координати пустої ячейки
	this.getNull=function(){ 
		for (var i = 0; i < 16; i++) {
			if (arr1[i] === 0) {
				//var nu=i;
			}
		}
	};	

	// умова перемоги)))
	this.victory = function() {
		var v = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,0];
		var res = true;
		for (var i = 0; i < 16; i++) {
			if (v[i] != arr1[i]) {
				res = false;
			}
		}
		return res;
	};

	// метод переміщує кубик в пустую ячейку 
	this.move = function(x, y) {
		var nullX = this.getNull();
		var m = e[x][y]; // індекс елементу масиву, який потрібно пересунути
		var x = arr[m]; // елемент який необхідно пересунути
		if(arr1[(m-4)]==0){
			arr1[(m-4)]=arr1[x];
			arr1[m]=0;
		}

		else if(arr1[(m+4)]==0){
			arr1[(m+4)]=arr1[x];
			arr1[m]=0;
		}

		else if(arr1[(m-1)]==0){
			arr1[(m-1)]=arr1[x];
			arr1[m]=0;
		}

		else if(arr1[(m+1)]==0){
			arr1[(m+1)]=arr1[x];
			arr1[m]=0;
		}

	this.reflash(arr1);
	};

	this.reflash=function(arr1){
		for(var i=0; i<4; i++){
			for(var j=0; j<4; j++){
				ctx.fillStyle="#9400D3";
				ctx.fillRect(i*size,j*size,99,99);
			}
		};

		var n=-1;
		for(var i=0; i<4; i++){
			for(var j=0; j<4; j++){
				n++
				ctx.fillStyle="#EED5B7";
				ctx.font = "italic bold 48px sans-serif";
				ctx.fillText(arr1[n], i * size + size / 4, j * size + size / 1.5);
							
				if(arr1[n]===0){
					ctx.fillStyle="black";
					ctx.fillRect(i*size,j*size,99,99);
					var nu=n;
				}	
			}
		}
	};	

}
	
// початок гри	
function play(){
	var field = new game();
	field.draw();
	field.write();
	field.getNull();
	field.onclick();

	function event(x, y) { // проводить дії після кліку
		field.move(x, y);
		field.draw();
		field.reflash(arr1);
		if (field.victory()) { // якщо все зібрано то виводиться повідомлення про перемогу
			alert("Зібрано за "+field.onclick()+" кліків!");
		}
		
	};				

	bord.onclick=function(e){
		//alert(field.onclick());
				/* таймер працює не корректно (при натисканні на дошку - секундомір зупиняється після чого знову стартує)
				t=0;
				function a(){
    			document.getElementById('a').innerHTML = t;
    			t++;
    			setTimeout("a()", 1000);
				}*/

		var x = Math. floor((e.pageX - bord.offsetLeft)/100);
		var y = Math. floor((e.pageY - bord.offsetTop)/100);
		event(x, y); // викликає дію
	};

}