<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Grafik</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter&display=swap");
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="max-w-6xl mx-auto p-6">
   

    <div class="text-sm text-gray-500 mb-4">
      Dashboard / <span class="text-blue-600 font-medium">Grafik</span>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <h2 class="text-lg font-medium mb-4">Statistik Perkembangan Data</h2>
      <div class="overflow-x-auto">
        <svg viewBox="0 0 800 300" class="w-full h-72">
          <defs>
            <linearGradient id="gradientFill" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#1e40af" />
              <stop offset="50%" stop-color="#6366f1" />
              <stop offset="100%" stop-color="white" />
            </linearGradient>
            <linearGradient id="lineGradient" x1="0" y1="0" x2="1" y2="0">
              <stop offset="0%" stop-color="#1e40af" />
              <stop offset="100%" stop-color="#6366f1" />
            </linearGradient>
          </defs>

          <!-- Grid Lines -->
          <g stroke="#e5e7eb" stroke-width="1">
            <line x1="0" y1="50" x2="800" y2="50" />
            <line x1="0" y1="100" x2="800" y2="100" />
            <line x1="0" y1="150" x2="800" y2="150" />
            <line x1="0" y1="200" x2="800" y2="200" />
            <line x1="0" y1="250" x2="800" y2="250" />
          </g>

          <!-- Gradient Area -->
          <path
            d="M 10 230 L 50 180 L 90 210 L 130 190 L 170 200 L 210 120 L 250 230 L 290 180 L 330 160 L 370 170 L 410 140 L 450 150 L 490 180 L 530 160 L 570 190 L 610 170 L 650 180 L 690 160 L 730 180 L 770 170 L 790 180 L 790 300 L 10 300 Z"
            fill="url(#gradientFill)"
            fill-opacity="0.4"
          />

          <!-- Data Line -->
          <path
            d="M 10 230 L 50 180 L 90 210 L 130 190 L 170 200 L 210 120 L 250 230 L 290 180 L 330 160 L 370 170 L 410 140 L 450 150 L 490 180 L 530 160 L 570 190 L 610 170 L 650 180 L 690 160 L 730 180 L 770 170 L 790 180"
            stroke="url(#lineGradient)"
            stroke-width="3"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          />

          <!-- X Axis Labels -->
          <g fill="#6b7280" font-size="12" font-family="Inter">
            <text x="10" y="290">10</text>
            <text x="90" y="290">20</text>
            <text x="170" y="290">30</text>
            <text x="250" y="290">40</text>
            <text x="330" y="290">50</text>
            <text x="410" y="290">60</text>
            <text x="490" y="290">70</text>
            <text x="570" y="290">80</text>
            <text x="650" y="290">90</text>
            <text x="730" y="290">100</text>
          </g>

          <!-- Y Axis Labels -->
          <g fill="#6b7280" font-size="12" font-family="Inter">
            <text x="0" y="55">250</text>
            <text x="0" y="105">200</text>
            <text x="0" y="155">150</text>
            <text x="0" y="205">100</text>
            <text x="0" y="255">50</text>
          </g>
        </svg>
      </div>
    </div>
  </div>
</body>
</html>
