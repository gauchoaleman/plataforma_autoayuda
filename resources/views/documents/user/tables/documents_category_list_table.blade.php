<?php
 $category_documents = DB::table('documents')->where('category_id', $_GET["document_category_id"])->get();
 $category_name = get_category_name_from_id($_GET["document_category_id"]);
?>


<div class="container">
  <div class="card">
    <div class="card-header" style="color:orange">Documentos de la categoría {{$category_name}}</div>
    <div class="card-body">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="color:orange">Nombre</th>
      <th scope="col"  style="color:orange"><div align="center">Mostrar documento</div></th>
    </tr>
  </thead>
  <tbody>
@foreach($category_documents as $category_document)
  <tr>
  <td>
    {{ $category_document->title }}

  </td>
  <td align="center">
  <a href="/documents/user/show_document_user?id={{ $category_document->id }}"><img src="/img/no.png"</a>
  </td>
  </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
