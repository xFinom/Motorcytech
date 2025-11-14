import {
    Bike,
    Bolt,
    ChartNoAxesCombined,
    Share2,
    ShoppingCart,
    Star,
    Store,
    UserCog,
    Users,
    Wrench,
} from 'lucide-vue-next'

export const serviceOrderMenu = [
    {
        title: 'Ordenes de Servicio',
        url: '#',
        icon: Wrench,
        isActive: true,
        items: [
            {
                title: 'Registro',
                url: route('dashboard.service.orders.create'),
            },
            {
                title: 'En proceso',
                url: route('dashboard.service.orders.historic'),
            },
            {
                title: 'Histórico',
                url: route('dashboard.service.orders.index'),
            },
        ],
    },
    {
        title: 'Clientes',
        url: '#',
        icon: Users,
        isActive: true,
        items: [
            {
                title: 'Histórico',
                url: route('dashboard.client.historic'),
            },
        ],
    },
    {
        title: 'Motocicletas',
        url: '#',
        icon: Bike,
        isActive: true,
        items: [
            {
                title: 'Histórico',
                url: route('dashboard.motorcycles.index'),
            },
        ],
    },
    {
        title: 'Reseñas',
        url: '#',
        icon: Star,
        isActive: true,
        items: [
            {
                title: 'Por validar',
                url: route('dashboard.reviews.index'),
            },
            {
                title: 'Histórico',
                url: route('dashboard.reviews.historic'),
            },
        ],
    },
]

export const financeMenu = [
    {
        title: 'Proyecciones',
        url: route('dashboard.forecast'),
        icon: ChartNoAxesCombined,
    },
    {
        title: 'Refacciones asociadas',
        url: route('dashboard.itemsets'),
        icon: Share2,
    },
]

export const employeeMenu = [
    {
        title: 'Personal',
        url: route('dashboard.workers.index'),
        icon: UserCog,
    },
    {
        title: 'Proveedores',
        url: route('dashboard.suppliers.index'),
        icon: Bolt,
    },
]

export const salesMenu = [
    {
        title: 'Inventario',
        url: route('dashboard.store.items.index'),
        icon: Store,
    },
    {
        title: 'Ventas',
        url: route('dashboard.purchase.orders.index'),
        icon: ShoppingCart,
    },
]
