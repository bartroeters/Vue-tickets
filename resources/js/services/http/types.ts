import type {AxiosError, AxiosRequestConfig, AxiosResponse} from 'axios';

/** The `AxiosRequestConfig` type represents the configuration options for an Axios request.
 * The `AxiosResponse` type represents the response returned from an Axios request.
 */

export type RequestMiddleware = (request: AxiosRequestConfig) => void;
/** Modify the request object before it is sent. */
export type ResponseMiddleware = (response: AxiosResponse) => void;
/** Modify the response object before it is returned. */
export type ResponseErrorMiddleware = (error: AxiosResponseError) => void;
/** Handle errors */

/**
 * `AxiosResponseError` is a custom type that extends the `AxiosError` type from the axios library.
 * `AxiosError` adds additional properties to the error object: a message property and an errors property.
 */

type AxiosResponseError = AxiosError<
    {
        message?: string;
        errors?: {
            [property: string]: string[];
        };
    },
    unknown
>;