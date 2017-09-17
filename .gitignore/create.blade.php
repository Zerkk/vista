@extends ('layouts.admin')
@section('contenido')
<style type="text/css">

.polig{
width:10px;
height:10px;
background:#444444;
font-family:arial;
font-weight:bold;
color:#EEEEEE;


}



</style>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

		<h3>Nuevo Producto</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Nombre</label>

		<input class="form-control" required value="{{old('nombre')}}" type="text" id="inNombre" name="nombre" placeholder="Nombre">
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Codigo</label>
		<input class="form-control" required value="{{old('codigo')}}" type="text" id="inCodigo" name="codigo" placeholder="Codigo">
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<label for="codigo"> Descripcion</label>
		<input class="form-control" required value="{{old('descripcion')}}" type="text" id="inDescripcion" name="descripcion" placeholder="Descripcion">
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Categorias</label>
		 	<div class="input-group">
				<select id="CategoriasSelect" name="idt_categoria" class="form-control" >
					@foreach($categorias as $cat)
           				<option value="{{$cat->idt_categoria}}">{{$cat->nombre}}</option>
					@endforeach
				</select>
				<span class="input-group-btn">
        			<a class="btn btn-primary " href="#" role="button" onclick="CrearBotonCategorias()">Añadir</a>
      			</span>
			</div>
		<small class="text-muted" >*Clic en la Categoria para eliminarla</small>
		<br>
			<div class="alert alert-info" role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivCategorias">
    				<!-- Botones de categorias agregados -->
  					</div>
				</div>

			</div>



	</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Colores</label>
		 	<div class="input-group">
				<select id="ColoresSelect" name="idt_color" class="form-control" >
					@foreach($colores as $coloKey)
           				<option   value="{{$coloKey->idt_color}}" style="background-color:{{$coloKey->color}};">
           					{{$coloKey->nombre}}
           				</option>
					@endforeach
				</select>
				<span class="input-group-btn">
        			<a class="btn btn-primary " href="#" role="button" onclick="CrearBotonColores()">Añadir</a>
      			</span>
			</div>
		<small class="text-muted" >*Clic en el Color para eliminarlo</small>
		<br>
			<div class="alert " role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivColores">
    				<!-- Botones de categorias agregados -->
  					</div>
				</div>
			</div>


	</div>
	</div>
</div>
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Tallas</label>
		 	<div class="input-group">
				<select id="TallasSelect" name="idt_categoria" class="form-control" >
					@foreach($tallas as $tallaKey)
           				<option value="{{$tallaKey->idt_talla}}">{{$tallaKey->nombre}}</option>
					@endforeach
				</select>
				<span class="input-group-btn">
        			<a class="btn btn-primary " href="#" role="button" onclick="CrearBotonTallas()">Añadir</a>
      			</span>
			</div>
			<small class="text-muted" >*Clic en la Talla para eliminarla</small>
		<br>
			<div class="alert alert-warning" role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivTallas">
    				<!-- Botones de tallas agregados -->
  					</div>
				</div>
			</div>


	</div>
	</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Imagenes</label>
		 	<div class="input-group">
		 		<input type="file" id="Imagenes" class="filestyle" name="files[]" accept=".jpg, .jpeg, .png" data-btnClass="btn-primary" multiple>

				<output id="list"></output>
			</div>
		<br>
			<div class="alert alert-success" role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivImagenes">
    				<!-- Botones de categorias agregados -->
  					</div>
				</div>
			</div>


	</div>
	</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div>
		<div class="form-group">
			<a class="btn btn-primary" onclick="FuncionGuardar()" role="button">Guardar</a>
			<a class="btn btn-danger" href="javascript:window.history.back();" role="button">Cancelar</a>
		</div>

	</div>
</div>

<script type="text/javascript">

var contCategorias=0;
var arrayCategorias = new Array();
	function CrearBotonCategorias() {
		var combo = document.getElementById("CategoriasSelect");

		var selected = combo.options[combo.selectedIndex].text;

		arrayCategorias[contCategorias] = selected;

		//agrega boton
		var boton =document.createElement('input');
   			boton.type = 'button';
   			boton.id = 'Categoria'+contCategorias;
   			boton.value = selected;
   			boton.setAttribute('class', 'btn btn-success');
   			boton.setAttribute('onclick', 'BorrarBotonCategorias(this.id,'+contCategorias+')');
   		document.getElementById('DivCategorias').appendChild(boton);

		contCategorias=contCategorias+1;
		//alert(JSON.stringify(arrayCategorias));
	}
	function BorrarBotonCategorias(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array

		delete arrayCategorias[iteracion];
		//alert(JSON.stringify(arrayCategorias));
	}
	//crear boton para Cada color elegido
var contColores=0;
var arrayColores = new Array();
	function CrearBotonColores() {
		var combo = document.getElementById("ColoresSelect");

		var selected = combo.options[combo.selectedIndex].text;
		arrayColores[contColores] = selected;
		//saca el color del select
		var property = "backgroundColor";
		var objeto=combo.options[combo.selectedIndex];
		var ColorRbg=objeto.style[property];


		//agrega boton
		var boton =document.createElement('input');
   			boton.type = 'button';
   			boton.id = 'Color'+contColores;
   			boton.value = selected;
   			boton.setAttribute('class', 'btn btn-danger');
   			boton.setAttribute('style', 'background-color:'+ColorRbg+';');
   			boton.setAttribute('onclick', 'BorrarBotonColores(this.id,'+contColores+')');
   		document.getElementById('DivColores').appendChild(boton);

		contColores=contColores+1;
		//alert(JSON.stringify(arrayColores));
	}
	function BorrarBotonColores(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array

		delete arrayColores[iteracion];
		//alert(JSON.stringify(arrayColores));


	}
	//crear boton para Cada talla elegida
var contTallas=0;
var arrayTallas = new Array();
	function CrearBotonTallas() {
		var combo = document.getElementById("TallasSelect");

		var selected = combo.options[combo.selectedIndex].text;

		arrayTallas[contTallas] = selected;

		//agrega boton
		var boton =document.createElement('input');
   			boton.type = 'button';
   			boton.id = 'Talla'+contTallas;
   			boton.value = selected;
   			boton.setAttribute('class', 'btn btn-danger');
   			boton.setAttribute('onclick', 'BorrarBotonTallas(this.id,'+contTallas+')');
   		document.getElementById('DivTallas').appendChild(boton);

		contTallas=contTallas+1;
		//alert(JSON.stringify(arrayCategorias));
	}
	function BorrarBotonTallas(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array

		delete arrayTallas[iteracion];
		//alert(JSON.stringify(arrayCategorias));
	}


//crear boton para Cada Imagen elegida
var contImagenes=0;
var arrayImagenes = new Array();
	function CrearBotonImagenes(evt) {
		var files = evt.target.files;
		for (var i = 0, f; f = files[i]; i++) {
			if (!f.type.match('image.*')) {
        	continue;
        	}
        	arrayImagenes[contImagenes]=files[i];
        	var reader = new FileReader();
        	reader.onload = (function(theFile, contImagenesS) {
        		return function(e) {
        			var id='Imagen'+contImagenesS;
        			var span = document.createElement('span');
        			span.innerHTML = ['<img class="thumb" id ="'+id+'" onClick="BorrarBotonImagenes(this.id,'+contImagenesS+')" height="42" width="42" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
        			document.getElementById('DivImagenes').insertBefore(span, null);
        		};

        	})(f,contImagenes);
        	reader.readAsDataURL(f);
        	contImagenes=contImagenes+1;

      	}
      	//alert(JSON.stringify(arrayImagenes));

	}
		function BorrarBotonImagenes(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array

		delete arrayImagenes[iteracion];
		//alert(JSON.stringify(arrayCategorias));
	}



	function FuncionGuardar() { //Envia Datos Al controlador
		//guardar variables de la tabla producto
    	var Vnombre = document.getElementById("inNombre").value;
    	var Vcodigo = document.getElementById("inCodigo").value;
    	var Vdescripcion = document.getElementById("inDescripcion").value;
    	//guardar variables de la categoria
    	var arrayCategoriasAux = new Array();
    	var ContadorAuxCate=0;
    	for (var i = 0; i < arrayCategorias.length; i++) {
    		if (arrayCategorias[i]!=null) {
			arrayCategoriasAux[ContadorAuxCate]=arrayCategorias[i];
			ContadorAuxCate=ContadorAuxCate+1;
    		}

    	}
    	//guarda variables de los colores
    	var arrayColoresAux = new Array();
    	var ContadorAuxColo=0;
    	for (var i = 0; i < arrayColores.length; i++) {
    		if (arrayColores[i]!=null) {
			arrayColoresAux[ContadorAuxColo]=arrayColores[i];
			ContadorAuxColo=ContadorAuxColo+1;
    		}

    	}

    	//guardar variables de la talla
    	var arrayTallasAux = new Array();
    	var ContadorAuxTalla=0;
    	for (var i = 0; i < arrayTallas.length; i++) {
    		if (arrayTallas[i]!=null) {
			arrayTallasAux[ContadorAuxTalla]=arrayTallas[i];
			ContadorAuxTalla=ContadorAuxTalla+1;
    		}

    	}

    	 //guardar variables de la Imagen
    	var arrayImagenAux = new Array();
    	var ContadorAuxImagen=0;
    	for (var i = 0; i < arrayImagenes.length; i++) {
    		if (arrayImagenes[i]!=null) {
			arrayImagenAux[ContadorAuxImagen]=arrayImagenes[i];
			ContadorAuxImagen=ContadorAuxImagen+1;
    		}

    	}
    	//var a=arrayImagenAux.fieldSerialize();
    	//var st="";
    	//for (var i = 0; i < arrayImagenAux.length; i++) {
    	//	st=(arrayImagenAux[i].name)+" "+st;

    	//}
    	//alert(st);
    	//var url="{{url('/crear')}}";
    	//var a=JSON.stringify(arrayImagenAux);

    	        $.ajax({
    	        	url:   '/crear',
    	        	type:  'get',
    	        	cache: 'false',
        			contentType: 'false',
        			processData: 'false',
                	data:  {'nombre':Vnombre,'codigo':Vcodigo,'descripcion':Vdescripcion,'arrayCategorias':arrayCategoriasAux,'arrayColores':arrayColoresAux,'arrayTallas':arrayTallasAux}
                }).done(function(data){

                	window.location.replace("/almacen/producto");
                });
	}


 document.getElementById('Imagenes').addEventListener('change', CrearBotonImagenes, false);
</script>

@endsection
