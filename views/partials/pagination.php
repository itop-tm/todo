<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php foreach ($paginator->getPages() as $page): ?>
            <?php if ($page['url']): ?>
                <li 
                    class="page-item <?= $page['isCurrent'] ? 'active' : ''; ?>"
                >
                    <a 
                        class="page-link"
                        href="<?= $page['url']; ?>"><?= $page['num']; ?>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span><?= $page['num']; ?></span>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</nav>