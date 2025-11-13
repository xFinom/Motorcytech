import { z } from 'zod'

export const sparePartQuoteSchema = z.object({
    name: z.string().min(1, 'El nombre es obligatorio'),
    quantity: z.number().int().positive('La cantidad debe ser mayor a 0'),
    price: z.number().positive('El precio debe ser mayor a 0'),
})

export const sparePartQuotesSchema = z.array(sparePartQuoteSchema)

export type SparePartQuoteForm = z.infer<typeof sparePartQuoteSchema>
