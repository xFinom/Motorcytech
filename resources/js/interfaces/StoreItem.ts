import { PurchaseOrder } from '@/interfaces/PurchaseOrder'
import { PaginatedList } from '@/interfaces/PaginatedList'

export interface StoreItem {
    id: number
    name: string
    description: string | null
    quantity: number
    price: number
    purchaseOrders: PurchaseOrder[]
}

export type PaginatedStoreItemList = PaginatedList<StoreItem>
