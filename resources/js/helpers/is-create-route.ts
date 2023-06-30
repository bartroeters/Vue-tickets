import { useRoute } from 'vue-router';

export function isEditRoute(resourceName: string, createKeyword = 'create'): boolean {
  const routeName = `${resourceName}.${createKeyword}`;
  return !(useRoute().name as string).startsWith(routeName);
}
