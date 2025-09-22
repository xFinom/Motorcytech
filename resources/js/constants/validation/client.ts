import { z } from 'zod'

import { rfcRegex } from '@/utils/regex'

export const clientSchema = z.object({
    name: z.string(),
    email: z.string().email(),
    phone: z.string(),
    address: z.string(),
    rfc: z.string().regex(rfcRegex, 'RFC invalido').optional().or(z.literal('')),
})

export type ClientForm = z.infer<typeof clientSchema>
