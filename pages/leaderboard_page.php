<?php
include("./assets/header_pages.php");
include("./assets/leaderboard_page_inc.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Leaderboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap"
    rel="stylesheet" />
</head>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 font-roboto">
  <div class="container mx-auto p-6">

    <main>

      <!-- Leaderboard Table -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-blue-800 mb-6">🏆 Top Rankings</h2>
        <?php if ($topUsersResult->num_rows > 0): ?>
          <table class="w-full border-collapse bg-gray-50 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-blue-200 text-blue-900">
                <th class="px-4 py-3 font-medium">Rank</th>
                <th class="px-4 py-3 font-medium">Username</th>
                <th class="px-4 py-3 font-medium">Points</th>
              </tr>
            </thead>
            <tbody>
              <?php $rowCount = 0; ?>
              <?php while ($row = $topUsersResult->fetch_assoc()): ?>
                <?php $rowCount++; ?>
                <tr class="hover:bg-blue-100 transition">
                  <td class="border px-4 py-3 text-center"><?php echo $rowCount; ?></td>
                  <td class="border px-4 py-3 flex items-center">

                    <?php echo htmlspecialchars($row['username']); ?>
                  </td>
                  <td class="border px-4 py-3 text-center"><?php echo htmlspecialchars($row['score']); ?> XP</td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p class="text-center text-gray-500 mt-6">No users found.</p>
        <?php endif; ?>
      </div>

      <!-- Your Position -->
      <h6 class="text-2xl font-semibold text-blue-800 mt-10 mb-6">✨ Your Position</h6>
      <?php if ($currentUserResult->num_rows > 0): ?>
        <?php while ($row = $currentUserResult->fetch_assoc()): ?>
          <div class="bg-white p-6 rounded-lg shadow-lg flex items-center gap-6">
            <!-- <img
              alt="User avatar of <?php echo htmlspecialchars($user_data['image_path']); ?>"
              class="w-12 h-12 rounded-full"
              src="https://via.placeholder.com/50jrfeh" /> -->
            <div>
              <h3 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($row['username']); ?></h3>
              <p class="text-gray-600">Position: <span class="font-medium text-gray-900"><?php echo htmlspecialchars($row['position']); ?></span></p>
              <p class="text-gray-600">Points: <span class="font-medium text-gray-900"><?php echo htmlspecialchars($row['score']); ?> XP</span></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center text-gray-500">Current user not found.</p>
      <?php endif; ?>

    </main>
  </div>
  <?php include("./assets/footer_pages.php") ?>
</body>

</html>