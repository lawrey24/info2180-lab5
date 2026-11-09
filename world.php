<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country= isset($_GET['country']) ? trim($_GET['country']) : '';
$cities= isset($_GET['lookup-cities']) ? trim($_GET['lookup-cities']): '';

$lookupCities = isset($_GET['lookup-cities']) ? $_GET['lookup-cities'] : '';
 if($lookupCities == 'cities'){
  $stmt = $conn->prepare("SELECT c.name AS name, c.district AS district, c.population AS population
                          FROM cities c
                          JOIN countries co ON c.country_code = co.code
                          WHERE co.name LIKE :country");
  $stmt->execute(['country' => "%$country%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $row):?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['district']) ?></td>
            <td><?= htmlspecialchars($row['population']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
 }else{
  $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
  $stmt->execute(['country' => "%$country%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Continent</th>
      <th>Independence Year</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row):?>
      <tr>
          <td><?= $row['name'] ?></td>
          <td><?= $row['continent'] ?></td>
          <td><?= $row['independence_year'] ?></td>
          <td><?= $row['head_of_state'] ?></td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
<?php
}
?>
