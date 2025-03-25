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
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'poppins': ['Poppins', 'sans-serif'],
          },
          colors: {
            'primary': '#4169E1',
            'primary-light': '#6B8EF2',
            'primary-dark': '#2A4CC1',
            'accent': '#FFA500',
            'accent-light': '#FFD700',
          },
          boxShadow: {
            'card': '0 10px 20px rgba(0, 0, 0, 0.1)',
            'highlight': '0 0 15px rgba(255, 215, 0, 0.7)',
          },
          animation: {
            'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            'float': 'float 3s ease-in-out infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': {
                transform: 'translateY(0)'
              },
              '50%': {
                transform: 'translateY(-10px)'
              },
            }
          }
        }
      }
    }
  </script>
  <style>
    .trophy-shine {
      position: relative;
      overflow: hidden;
    }

    .trophy-shine::after {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(60deg, rgba(255, 255, 255, 0) 20%, rgba(255, 255, 255, 0.3) 25%, rgba(255, 255, 255, 0) 30%);
      transform: rotate(30deg);
      animation: shine 4s infinite;
    }

    @keyframes shine {
      0% {
        left: -100%;
        top: -100%;
      }

      100% {
        left: 100%;
        top: 100%;
      }
    }

    .rank-badge {
      position: relative;
      display: inline-block;
    }

    .rank-badge::before {
      content: "";
      position: absolute;
      top: -5px;
      left: -5px;
      right: -5px;
      bottom: -5px;
      border-radius: 50%;
      z-index: -1;
    }

    .rank-1::before {
      background: radial-gradient(circle, #FFD700, transparent 70%);
      animation: pulse 2s infinite;
    }

    .rank-2::before {
      background: radial-gradient(circle, #C0C0C0, transparent 70%);
    }

    .rank-3::before {
      background: radial-gradient(circle, #CD7F32, transparent 70%);
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(255, 215, 0, 0.7);
      }

      70% {
        box-shadow: 0 0 0 10px rgba(255, 215, 0, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(255, 215, 0, 0);
      }
    }

    .bg-gradient-rank {
      background-image: linear-gradient(to right, rgba(65, 105, 225, 0.05), rgba(65, 105, 225, 0.1), rgba(65, 105, 225, 0.05));
    }

    .progress-bar {
      position: relative;
      height: 8px;
      border-radius: 4px;
      background: #E5E7EB;
      overflow: hidden;
    }

    .progress-value {
      height: 100%;
      border-radius: 4px;
      background: linear-gradient(to right, #4169E1, #6B8EF2);
      transition: width 1s ease;
    }
  </style>

</head>
<?php include("./assets/fab.php"); ?>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 font-poppins min-h-screen">
  <div class="container mx-auto p-4 md:p-6 max-w-5xl">

    <!-- Header Section -->
    <div class="text-center mb-8">
      <h1 class="text-3xl md:text-4xl font-bold text-primary-dark mb-2">Global Leaderboard</h1>
      <p class="text-gray-600">Compete with the best learners worldwide and rise to the top!</p>

      <!-- Period Selector -->
      <div class="flex justify-center mt-4 bg-white rounded-full shadow-md inline-block p-1">
        <button class="px-4 py-2 rounded-full bg-primary text-white font-medium">All Time</button>
      </div>
    </div>
    <!-- <div class="container mx-auto p-6"> -->

    <main>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <!-- <h2 class="text-2xl font-semibold text-blue-800 mb-6">🏆 Top Rankings</h2> -->
        <h2 class="text-xl font-semibold text-primary-dark flex items-center">
          <i class="fas fa-list-ol mr-3 text-primary-light"></i>
          Leaderboard Rankings
        </h2>
        <?php if ($topUsersResult->num_rows > 0): ?>
          <table class="w-full border-collapse bg-gray-50 rounded-lg overflow-y-auto">
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
                  <td class="border px-4 py-3 text-center"><?php echo htmlspecialchars($row['score']); ?><span class="text-amber-500">XP</span></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p class="text-center text-gray-500 mt-6">No users found.</p>
        <?php endif; ?>
      </div>



      <div class="mt-10">
        <h2 class="text-xl font-semibold text-primary-dark mb-4 flex items-center">
          <i class="fas fa-user-circle mr-2"></i>
          Your Position
        </h2>
        <?php if ($currentUserResult->num_rows > 0): ?>
          <?php while ($row = $currentUserResult->fetch_assoc()): ?>
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-card p-6 border-l-4 border-primary">
              <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                  <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-primary-light text-white flex items-center justify-center text-2xl font-bold mr-4">
                    <?php echo substr(htmlspecialchars($row['username']), 0, 1); ?>
                  </div>
                  <div>
                    <h3 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($row['username']); ?></h3>
                    <div class="flex items-center mt-1">
                      <span class="text-gray-600 mr-4">Rank: <span class="font-bold text-primary">#<?php echo htmlspecialchars($row['position']); ?></span></span>
                    </div>
                  </div>

                  
                  <div class="bg-white px-6 py-3 rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-star text-accent mr-2"></i>
                    <span class="text-2xl font-bold text-primary-dark"><?php echo htmlspecialchars($row['score']); ?></span>
                    <span class="ml-1 text-accent font-medium">XP</span>
                  </div>
                </div>
                <div class="mt-6 flex flex-wrap gap-4">
                  <a href="../courses.php" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Continue Learning
                  </a>
                  
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p class="text-center text-gray-500">Current user not found.</p>
          <?php endif; ?>
            </div>

    </main>
  </div>
  <?php include("./assets/footer_pages.php") ?>
  <script src="./assets/fab.js"></script>
</body>

</html>




<!-- <h6 class="text-2xl font-semibold text-blue-800 mt-10 mb-6">✨ Your Position</h6>
<?php if ($currentUserResult->num_rows > 0): ?>
        <?php while ($row = $currentUserResult->fetch_assoc()): ?>
          <div class="bg-white p-6 rounded-lg shadow-lg flex items-center gap-6">
            <div>
              <h3 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($row['username']); ?></h3>
              <p class="text-gray-600">Position: <span class="font-medium text-gray-900"><?php echo htmlspecialchars($row['position']); ?></span></p>
              <p class="text-gray-600">Points: <span class="font-medium text-gray-900"><?php echo htmlspecialchars($row['score']); ?> XP</span></p>
              
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center text-gray-500">Current user not found.</p>
      <?php endif; ?> -->