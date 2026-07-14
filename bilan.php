<?php
$con = mysqli_connect('localhost', 'root', '', 'bdbac23') or die(mysqli_error($con));
mysqli_set_charset($con, 'utf8mb4');

$reqMoy = "SELECT m.libelle,
                  COUNT(*) AS nbTests,
                  AVG(e.securite) AS moySecurite,
                  AVG(e.conduite) AS moyConduite,
                  AVG(e.confort)  AS moyConfort
           FROM evaluation e
           JOIN modelevoiture m ON m.idModele = e.idModele
           GROUP BY m.idModele, m.libelle
           ORDER BY m.libelle";
$resMoy = mysqli_query($con, $reqMoy) or die(mysqli_error($con));

$reqDet = "SELECT t.numPermis, t.nom, t.prenom, m.libelle, e.dateTest,
                  e.securite, e.conduite, e.confort
           FROM evaluation e
           JOIN testeur t ON t.numPermis = e.numPermis
           JOIN modelevoiture m ON m.idModele = e.idModele
           ORDER BY e.dateTest DESC";
$resDet = mysqli_query($con, $reqDet) or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bilan — Test Drive</title>
  <link rel="stylesheet" href="mesStyles.css">
  <style>
    body.bilan-body {
      background: var(--gray-50) !important;
      padding: 2rem;
      min-height: 100vh;
    }
    .bilan-wrap { max-width: 960px; margin: 0 auto; }
    .bilan-card {
      background: white;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-card);
      padding: 2rem 2.25rem 2.25rem;
      position: relative;
      overflow: hidden;
      margin-bottom: 1.5rem;
    }
    .bilan-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--brand-400), var(--brand-300), var(--brand-500));
    }
    .bilan-title {
      font-family: 'Syne', sans-serif;
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--brand-700);
      text-transform: uppercase;
      letter-spacing: 0.04em;
      margin-bottom: 1.25rem;
    }
    table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
    th, td { text-align: left; padding: 10px 12px; border-bottom: 1px solid var(--gray-200); }
    th {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--gray-400);
    }
    tr:last-child td { border-bottom: none; }
    .empty { color: var(--gray-400); font-style: italic; padding: 1rem 0; }
    .badge {
      display: inline-block;
      font-weight: 600;
      padding: 2px 8px;
      border-radius: 100px;
      background: var(--brand-50);
      color: var(--brand-700);
    }
  </style>
</head>
<body class="bilan-body">
  <div class="bilan-wrap">

    <div class="bilan-card">
      <div class="bilan-title">Moyennes par modèle</div>
      <?php if (mysqli_num_rows($resMoy) == 0): ?>
        <div class="empty">Aucune évaluation enregistrée pour le moment.</div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>Modèle</th>
              <th>Nb. tests</th>
              <th>Sécurité</th>
              <th>Conduite</th>
              <th>Confort</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($resMoy)): ?>
              <tr>
                <td><span class="badge"><?php echo htmlspecialchars($row['libelle']); ?></span></td>
                <td><?php echo (int)$row['nbTests']; ?></td>
                <td><?php echo number_format($row['moySecurite'], 1); ?> / 5</td>
                <td><?php echo number_format($row['moyConduite'], 1); ?> / 5</td>
                <td><?php echo number_format($row['moyConfort'], 1); ?> / 5</td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>

    <div class="bilan-card">
      <div class="bilan-title">Détail des évaluations</div>
      <?php if (mysqli_num_rows($resDet) == 0): ?>
        <div class="empty">Aucune évaluation enregistrée pour le moment.</div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>Testeur</th>
              <th>Permis</th>
              <th>Modèle</th>
              <th>Date</th>
              <th>Sécurité</th>
              <th>Conduite</th>
              <th>Confort</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($resDet)): ?>
              <tr>
                <td><?php echo htmlspecialchars($row['prenom'] . ' ' . $row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['numPermis']); ?></td>
                <td><?php echo htmlspecialchars($row['libelle']); ?></td>
                <td><?php echo htmlspecialchars($row['dateTest']); ?></td>
                <td><?php echo (int)$row['securite']; ?></td>
                <td><?php echo (int)$row['conduite']; ?></td>
                <td><?php echo (int)$row['confort']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>

  </div>
</body>
</html>
