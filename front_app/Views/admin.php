<!DOCTYPE html>
<html lang="ro">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina Admin</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&display=swap" rel="stylesheet">

  <script src="assets/js/userInserter.js" defer></script>
  <script src="assets/js/productTableInserter.js" defer></script>
</head>

<body>

  <?php require_once 'partials/header.php'; ?>


  <main>
    <section class="product-management">
      <article>
        <h2>Product Management</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Brand</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="products-table">
            <tr>
              <td data-label="ID">2</td>
              <td data-label="Name">Producty product</td>
              <td data-label="Brand">Brandy brand</td>
              <td><button>del</button></td>
            </tr>
          </tbody>
        </table>
      </article>
      <article>
        <h2>Add new product</h2>
        <form id="product-form" action='/admin' method='post' enctype="multipart/form-data">
          <label for="category">Product Category:</label >
          <select id="category" name="category" value="1">
          <?php foreach ($categories as $category): ?>
            <option value="<?= strval($category->id)?>"><?= $category->product_category?></option><br>
          <?php endforeach; ?>
          </select>
          <!-- Add more categories as needed -->

          <label for="zone">Product Zone:</label >
          <select id="zone" name="zone" value="1">
          <?php foreach ($zones as $zone): ?>
            <option value="<?= strval($zone->id)?>"><?= $zone->zone?></option>
          <?php endforeach; ?>
          </select>
          <!-- Add more zones as needed -->
          
          <label for="age-group">Product Age-group:</label >
          <select id="age-group" name="age-group" value="1">
          <?php foreach ($ageGroups as $ageGroup): ?>
            <option value="<?= strval($ageGroup->id)?>"><?= $ageGroup->group?></option>
          <?php endforeach; ?>
          </select>
          <!-- Add more age groups as needed -->

          <h3>Name:</h3>
          <input type="text" id="name" name="name">

          <h3>Brand:</h3>
          <input type="text" id="brand" name="brand">

          <h3>Description:</h3>
          <textarea id="description" name="description"></textarea>

          <h3>Picture:</h3>
          <input type="file" id="image" name="image">

          <!-- Occasions -->
            <div id="occasions" class="form-field">
              <h3>Occasions:</h3>
              <?php foreach ($occasions as $occasion): ?>
                <input type="checkbox" name="occasion_ids[]" value="<?= strval($occasion->id)?>">
                <label><?= $occasion->occasion?></label><br>
              <?php endforeach; ?>
            </div>

            <!-- Time of Day -->
            <div id="times-of-day" class="form-field">
              <h3>Time of Day:</h3>
              <?php foreach ($timeOfDays as $timeOfDay): ?>
                <input type="checkbox" name="time_of_day_ids[]" value="<?= strval($timeOfDay->id)?>">
                <label><?= $timeOfDay->timeOfDay?></label><br>
              <?php endforeach; ?>
            </div>

          <h3>Skin Type:</h3>
          <?php foreach ($skinTypes as $skinType): ?>
            <input type="checkbox" id="skin-types" name="skintype_ids[]" value="<?= strval($skinType->id)?>">
            <label for="skin-types"><?= $skinType->type?></label><br>
          <?php endforeach; ?>
          <!-- Add more skin types as needed -->

          <?php if (isset($error)) {
            echo '<p class="error">' . $error . '</p>';
          }?>

          <input type="submit" value="Add">
        </form>
      </article>
    </section>

    <section class="operations-approval">
      <h2>User management</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="users-table">
        </tbody>
      </table>
    </section>
  </main>


</body>

</html>