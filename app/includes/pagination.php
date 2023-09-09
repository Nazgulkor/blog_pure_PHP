<nav aria-label="Page navigation example ">
    <ul class="pagination w-100 d-flex justify-content-center">
        <li class="page-item" <?php if ($page == 1) echo "style='pointer-events:none; opacity:0.4'; "; ?>><a class="page-link" href="?page=1">First</a></li>
        <li class="page-item" <?php if ($page == 1) echo "style='pointer-events:none; opacity:0.4'; "; ?>>
            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li <?php if ($page == $i) echo "style='pointer-events:none; opacity:0.4'; "; ?> class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>

        <li class="page-item" <?php if ($page == $total_pages) echo "style='pointer-events:none; opacity:0.4'; "; ?>>
            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <li class="page-item" <?php if ($page == $total_pages) echo "style='pointer-events:none; opacity:0.4'; "; ?>><a class="page-link" href="?page=<?= $total_pages ?>">Last</a></li>
    </ul>
</nav>