<div class="row">
    <div class="col-sm-12">
        <ul class="pagination justify-content-center">
            <li class="page-item<? if ($this->paging->getPage() == '1'): ?> disabled<? endif; ?>">
                <a class="page-link" href="index.php?page=1">First</a>
            </li>
            <li class="page-item<? if ($this->paging->getPage() == '1'): ?> disabled<? endif; ?>">
                <a class="page-link" href="index.php?page=<?= $this->paging->getPage() - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <? for ($page_number = $this->paging->getStartPage(); $page_number <= $this->paging->getEndPage(); $page_number++): ?>
                <? if ($this->paging->getPage() == $page_number): ?>
                    <li class="page-item active">
                        <span class="page-link" href="index.php?page=<?= $page_number ?>"><?= $page_number ?></span>
                    </li>
                <? else: ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?= $page_number ?>"><?= $page_number ?></a>
                    </li>
                <? endif; ?>
            <? endfor; ?>
            <li class="page-item<? if ($this->paging->getPage() == $this->paging->getTotalPages()): ?> disabled<? endif; ?>">
                <a class="page-link" href="index.php?page=<?= $this->paging->getPage() + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item<? if ($this->paging->getPage() == $this->paging->getTotalPages()): ?> disabled<? endif; ?>">
                <a class="page-link" href="index.php?page=<?= $this->paging->getTotalPages() ?>">Last</a>
            </li>
        </ul>
    </div>
</div>
