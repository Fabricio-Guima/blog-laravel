@include('admin.includes.alerts')

<div class="form-group">
					<label for="name">Nome:</label>
					<input type="text "name="name" class="form-control" placeholder="Nome" value="{{$plan->name ?? old('name')}}">
				</div>

				<div class="form-group">
					<label for="name">Preço:</label>
					<input type="number "name="price" class="form-control" placeholder="Preço" value="{{$plan->price ?? old('price')}}">
				</div>

				<div class="form-group">
					<label for="description">Descrição:</label>
					<textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$plan->description ?? old('description')}}</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-dark">Enviar</button>
				</div>