import {
    Inbox,
    Clock,
    PauseCircle,
    CheckCircle,
    BadgeCheck,
} from "lucide-vue-next";

export enum ServiceOrderStatus {
    INGRESADO = 'Ingresado',
    EN_PROCESO = 'EnProceso',
    DETENIDO = 'Detenido',
    LISTO = 'Listo',
    FINALIZADO = 'Finalizado',
}

type Status = typeof ServiceOrderStatus[keyof typeof ServiceOrderStatus];

export const ServiceOrderStatusLabels: Record<Status, string> = {
    [ServiceOrderStatus.INGRESADO]: 'Ingresado',
    [ServiceOrderStatus.EN_PROCESO]: 'En Proceso',
    [ServiceOrderStatus.DETENIDO]: 'Detenido',
    [ServiceOrderStatus.LISTO]: 'Listo',
    [ServiceOrderStatus.FINALIZADO]: 'Finalizado',
} as const;

export const ServiceOrderStatusBadges: Record<Status, string> = {
    [ServiceOrderStatus.INGRESADO]:
        "bg-neutral-100 text-neutral-700 dark:bg-neutral-800 dark:text-neutral-200",

    [ServiceOrderStatus.EN_PROCESO]:
        "bg-sky-100 text-sky-700 dark:bg-sky-800 dark:text-sky-200",

    [ServiceOrderStatus.DETENIDO]:
        "bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200",

    [ServiceOrderStatus.LISTO]:
        "bg-emerald-100 text-emerald-700 dark:bg-emerald-800 dark:text-emerald-200",

    [ServiceOrderStatus.FINALIZADO]:
        "bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200",
} as const;

export const ServiceOrderStatusIcons: Record<Status, any> = {
    [ServiceOrderStatus.INGRESADO]: Inbox,
    [ServiceOrderStatus.EN_PROCESO]: Clock,
    [ServiceOrderStatus.DETENIDO]: PauseCircle,
    [ServiceOrderStatus.LISTO]: CheckCircle,
    [ServiceOrderStatus.FINALIZADO]: BadgeCheck,
} as const;
