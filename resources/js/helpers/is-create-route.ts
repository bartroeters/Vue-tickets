import { useRoute } from 'vue-router';

export function isCreateRoute(resourceName: string, createKeyword = 'create'): boolean {
  const routeName = `${resourceName}.${createKeyword}`;
  return !(useRoute().name as string).startsWith(routeName);
}
