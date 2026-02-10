<?php
?>
<div class="row g-3">
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card-modern p-3 kpi">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="text-uppercase small text-muted">Total Courses</div>
          <div class="display-6 fw-semibold counter" data-target="<?php echo (int)$totalCourses; ?>">0</div>
        </div>
        <i class="fa-solid fa-book text-primary" style="font-size:28px"></i>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card-modern p-3 kpi">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="text-uppercase small text-muted">Total Trainings</div>
          <div class="display-6 fw-semibold counter" data-target="<?php echo (int)$totalTrainings; ?>">0</div>
        </div>
        <i class="fa-solid fa-layer-group text-primary" style="font-size:28px"></i>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card-modern p-3 kpi">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="text-uppercase small text-muted">Total Enquiries</div>
          <div class="display-6 fw-semibold counter" data-target="<?php echo (int)$totalEnquiries; ?>">0</div>
        </div>
        <i class="fa-regular fa-message text-primary" style="font-size:28px"></i>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card-modern p-3 kpi">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="text-uppercase small text-muted">Registrations</div>
          <div class="display-6 fw-semibold counter" data-target="<?php echo (int)$totalRegistrations; ?>">0</div>
        </div>
        <i class="fa-solid fa-user-plus text-primary" style="font-size:28px"></i>
      </div>
    </div>
  </div>
</div>
<div class="row g-3 mt-1">
  <div class="col-12 col-xl-8">
    <div class="card-modern p-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="fw-semibold">Monthly Enquiries</div>
        <div class="text-muted small">Last 6 months</div>
      </div>
      <canvas id="chartEnquiries" height="120"></canvas>
    </div>
  </div>
  <div class="col-12 col-xl-4">
    <div class="card-modern p-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="fw-semibold">Course-wise Registrations</div>
        <div class="text-muted small">Top courses</div>
      </div>
      <canvas id="chartRegistrations" height="120"></canvas>
    </div>
  </div>
</div>
<div class="row g-3 mt-1">
  <div class="col-12 col-xl-4">
    <div class="card-modern p-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="fw-semibold">Course Category Distribution</div>
        <div class="text-muted small">Categories</div>
      </div>
      <canvas id="chartDistribution" height="120"></canvas>
    </div>
  </div>
</div>
<div class="row g-3 mt-1">
  <div class="col-12">
    <div class="card-modern p-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="fw-semibold">Recent Enquiries</div>
        <a class="btn btn-sm btn-outline-primary" href="/Software-Services/admin/enquiries.php">View all</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle" id="recentTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Course</th>
              <th>Source</th>
              <th>Status</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (($recentEnquiries ?? []) as $e): ?>
              <tr>
                <td><?php echo (int)$e['id']; ?></td>
                <td><?php echo htmlspecialchars($e['name']); ?></td>
                <td><?php echo htmlspecialchars($e['email']); ?></td>
                <td><?php echo htmlspecialchars($e['message']); ?></td>
                <td><span class="badge bg-primary-subtle text-primary"><?php echo htmlspecialchars($e['source']); ?></span></td>
                <td><span class="badge <?php echo ($e['status']==='new'?'bg-warning-subtle text-warning':'bg-success-subtle text-success'); ?>"><?php echo htmlspecialchars($e['status']); ?></span></td>
                <td><?php echo htmlspecialchars($e['created_at']); ?></td>
                <td>
                  <a class="btn btn-sm btn-outline-secondary" href="/Software-Services/admin/enquiries.php"><i class="fa-regular fa-eye"></i></a>
                  <button class="btn btn-sm btn-outline-danger btn-del" data-id="<?php echo (int)$e['id']; ?>"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center">
          <div class="text-muted small" id="tableInfo"></div>
          <nav><ul class="pagination pagination-sm m-0" id="tablePager"></ul></nav>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="mt-3">
  <a class="btn btn-outline-primary me-2" href="/Software-Services/admin/banners.php">Manage Banners</a>
  <a class="btn btn-outline-primary me-2" href="/Software-Services/admin/courses.php">Manage Courses</a>
  <a class="btn btn-outline-primary me-2" href="/Software-Services/admin/trainings.php">Manage Trainings</a>
  <a class="btn btn-outline-primary me-2" href="/Software-Services/admin/pages.php">Manage Pages</a>
  <a class="btn btn-outline-primary" href="/Software-Services/admin/enquiries.php">Manage Enquiries</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  (function() {
    var kpis = document.querySelectorAll('.counter');
    var obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var target = parseInt(el.getAttribute('data-target') || '0', 10);
          var cur = 0;
          var step = Math.max(1, Math.round(target / 40));
          var t = setInterval(function() {
            cur += step;
            if (cur >= target) { cur = target; clearInterval(t); }
            el.textContent = cur;
          }, 25);
          obs.unobserve(el);
        }
      });
    }, { threshold: .6 });
    kpis.forEach(function(el) { obs.observe(el); });

    var ctx1 = document.getElementById('chartEnquiries');
    if (ctx1) {
      var m = ['Jan','Feb','Mar','Apr','May','Jun'];
      var v = [12, 19, 7, 15, 22, <?php echo (int)$totalEnquiries; ?>];
      new Chart(ctx1, {
        type: 'line',
        data: { labels: m, datasets: [{ label: 'Enquiries', data: v, tension: .35, borderColor: '#2563eb', backgroundColor: 'rgba(37,99,235,.15)', fill: true }] },
        options: { plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { color: 'rgba(0,0,0,.05)' } } } }
      });
    }
    var ctx2 = document.getElementById('chartRegistrations');
    if (ctx2) {
      var c = ['Course A','Course B','Course C','Course D'];
      var v = [8, 12, 6, <?php echo (int)$totalRegistrations; ?>];
      new Chart(ctx2, {
        type: 'bar',
        data: { labels: c, datasets: [{ label: 'Registrations', data: v, backgroundColor: 'rgba(37,99,235,.6)' }] },
        options: { plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { color: 'rgba(0,0,0,.05)' } } } }
      });
    }
    var ctx3 = document.getElementById('chartDistribution');
    if (ctx3) {
      var labels = ['IT', 'Business', 'Design', 'Other'];
      var data = [30, 25, 20, Math.max(5, (<?php echo (int)$totalCourses; ?> - 75))];
      new Chart(ctx3, {
        type: 'doughnut',
        data: { labels, datasets: [{ data, backgroundColor: ['#1f77b4','#2ca02c','#ff7f0e','#9467bd'] }] },
        options: { plugins: { legend: { position: 'bottom' } } }
      });
    }

    var table = document.getElementById('recentTable');
    if (table) {
      var rows = Array.from(table.querySelectorAll('tbody tr'));
      var pager = document.getElementById('tablePager');
      var info = document.getElementById('tableInfo');
      var pageSize = 5;
      var page = 1;
      function render() {
        var total = rows.length;
        var pages = Math.max(1, Math.ceil(total / pageSize));
        page = Math.min(page, pages);
        rows.forEach(function(r, i) {
          var show = (i >= (page-1)*pageSize && i < page*pageSize);
          r.style.display = show ? '' : 'none';
        });
        info.textContent = 'Showing ' + ((page-1)*pageSize+1) + '–' + Math.min(page*pageSize, total) + ' of ' + total;
        pager.innerHTML = '';
        for (var p=1; p<=pages; p++) {
          var li = document.createElement('li');
          li.className = 'page-item' + (p===page ? ' active' : '');
          var a = document.createElement('a');
          a.className = 'page-link';
          a.href = '#';
          a.textContent = p;
          a.addEventListener('click', function(ev) { ev.preventDefault(); page = parseInt(this.textContent,10); render(); });
          li.appendChild(a);
          pager.appendChild(li);
        }
      }
      render();
      table.querySelectorAll('.btn-del').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var id = this.getAttribute('data-id');
          if (confirm('Delete enquiry #' + id + '?')) {
            var f = document.createElement('form');
            f.method = 'POST';
            f.action = '/training-admin/enquiries.php';
            var i1 = document.createElement('input');
            i1.type = 'hidden'; i1.name = 'id'; i1.value = id;
            var i2 = document.createElement('input');
            i2.type = 'hidden'; i2.name = 'status'; i2.value = 'deleted';
            f.appendChild(i1); f.appendChild(i2);
            document.body.appendChild(f);
            f.submit();
          }
        });
      });
    }
  })();
</script>
