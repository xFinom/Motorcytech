import {
    BanknoteArrowDown,
    BanknoteArrowUp,
    Bike,
    ChartNoAxesCombined,
    ShoppingCart,
    Star,
    Store,
    UserCog,
    Users,
    Wrench,
    Bolt,
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
                url: route('service.order.create'),
            },
            {
                title: 'Histórico',
                url: route('service.order.index'),
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
                title: 'Listado',
                url: route('userslist'),
            },
            {
                title: 'Mensajes',
                url: '#',
            },
        ],
    },
    {
        title: 'Motocicletas',
        url: route('motorcycleslist'),
        icon: Bike,
    },
    {
        title: 'Reseñas',
        url: route('reviews.validreview'),
        icon: Star,
    },
]

export const financeMenu = [
    {
        title: 'Proyecciones',
        url: route('dashboard.forecast'),
        icon: ChartNoAxesCombined,
    },
]

export const employeeMenu = [
    {
        title: 'Personal',
        url: route('workerslist'),
        icon: UserCog,
    },
    {
        title: 'Proveedores',
        url: route('supplierslist'),
        icon: Bolt,
    },
]

export const salesMenu = [
    {
        title: 'Inventario',
        url: '#',
        icon: Store,
    },
    {
        title: 'Ventas',
        url: '#',
        icon: ShoppingCart,
    },
]
