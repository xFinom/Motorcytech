import { StoreItem } from '@/interfaces/StoreItem'
import { Client } from '@/interfaces/User'

export interface PurchaseOrder {
    id: number
    client: Client
    items: StoreItem[]
}
