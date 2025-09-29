import { ReviewStatus } from '@/enums/ReviewStatus'
import { Client } from '@/interfaces/User'

export interface Review {
    id: string
    comment: string
    rating: number
    status: ReviewStatus
    client: Client
    created_at: string
}
