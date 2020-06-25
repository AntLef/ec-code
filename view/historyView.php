<?php ob_start(); ?>

<div class="container">


<h1 class="display-4">Mon historique</h1>



<table class="table" style="margin-top: 40px">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>        
    </tbody>
</table>


</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
