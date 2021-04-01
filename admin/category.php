<?php
     include '../lib/includes.php';
     include '../partials/admin_header.php';

/** Suppression **/

if(isset($_GET['delete'])){
     checkCsrf();
     $id=$db->quote($_GET['delete']);
     $db->query("DELETE FROM categories WHERE id=$id");
     setFlash('La catégorie a bien été supprimée');
     header('Location:category.php');
     die();
}

/** Catégories **/

$select = $db->query('SELECT id, name, slug FROM categories');
$categories = $select->fetchAll();

?>

<h1>Les catégories</h1>

<p><a href="category_edit.php" class="btn btn-success">Ajouter une nouvelle catégorie</p>

<table class="tablet table-striped">
     <thead>
          <tr>
               <th>Id</th>
               <th>Nom</th>
               <th>Actions</th>
          </tr>
     </thead>
     <tbody>
          <?php foreach($categories as $category): ?>
          <tr>
               <td><?= $category['id'];?></td>
               <td><?= $category['name'];?></td>
               <td>
                    <a href="category_edit.php?id=<?= $category['id']; ?>" class="btn btn-default">Edit</a>
                    <a href="?delete=<?= $category['id']; ?>&<?=csrf(); ?>" class="btn btn-erroe" on click="return confirm('Sûr de vous?');">Supprimer</a>
               </td>
          </tr>     
          <?php endforeach; ?>
     </tbody>

</table>


<?php '../partials/footer.php'; ?>