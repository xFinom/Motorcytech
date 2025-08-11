import {
    AtSign,
    BanknoteArrowDown,
    BanknoteArrowUp,
    Bike,
    ChartNoAxesCombined,
    ShoppingCart,
    SquareTerminal,
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
        icon: SquareTerminal,
        isActive: true,
        items: [
            {
                title: 'Registro',
                url: '#',
            },
            {
                title: 'Histórico',
                url: '#',
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
                url: '#',
            },
            {
                title: 'Mensajes',
                url: '#',
            },
        ],
    },
    {
        title: 'Motocicletas',
        url: '#',
        icon: Bike,
    },
    {
        title: 'Reseñas',
        url: '#',
        icon: Star,
    },
]

export const financeMenu = [
    {
        title: 'Proyecciones',
        url: '#',
        icon: ChartNoAxesCombined,
    },
    {
        title: 'Ganancias',
        url: '#',
        icon: BanknoteArrowUp,
    },
    {
        title: 'Gastos',
        url: '#',
        icon: BanknoteArrowDown,
    },
]

export const employeeMenu = [
    {
        title: 'Personal',
        url: '#',
        icon: UserCog,
    },
    {
        title: 'Proveedores',
        url: '#',
        icon: Wrench,
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
