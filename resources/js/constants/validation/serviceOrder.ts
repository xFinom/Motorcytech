import { z } from 'zod'

import { clientSchema } from '@/constants/validation/client'
import { motorcycleSchema } from '@/constants/validation/motorcycle'
import { serviceSchema } from '@/constants/validation/service'

export const serviceOrderSchema = z.object({
    client: clientSchema,
    motorcycle: motorcycleSchema,
    service: serviceSchema,
})

export type ServiceOrderForm = z.infer<typeof serviceOrderSchema>;
