import { Config } from 'ziggy-js'
import { User } from '@/interfaces/User'

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user?: User
    }
    ziggy: Config & { location: string }
    lex: {
        key: string,
        secret: string
        botId: string
        botAliasId: string
        sessionId: string
        localeId: string
    }
}
