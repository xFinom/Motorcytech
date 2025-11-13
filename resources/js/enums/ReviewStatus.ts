export enum ReviewStatus {
    PENDIENTE = 'Pendiente',
    VALIDADO = 'Validado',
}

const reviewStatusBadge: Record<ReviewStatus, string> = {
    [ReviewStatus.PENDIENTE]: 'bg-neutral-100 text-neutral-700 dark:bg-neutral-800 dark:text-neutral-200',
    [ReviewStatus.VALIDADO ]: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-800 dark:text-emerald-200',
}

const getReviewStatusBadge = (status: ReviewStatus) => {
    return reviewStatusBadge[status];
}
