import { i18n } from '@/i18n';

export const requiredRule = (value: string | number | boolean) => {
  const isValid =
    value !== null &&
    value !== undefined &&
    !(typeof value === 'string' && value.trim() === '') &&
    !(typeof value === 'boolean' && value === false);

  return isValid || i18n.global.t('rule.required');
};
